<template>
    <div class="Translate">
        <h1>Import JSON file</h1>
        <div>
            <div class="file">
                <label class="file-label">
                    <input class="file-input" type="file" name="resume" @change="loadFile" multiple accept="application/json">
                    <span class="file-cta">
                    <span class="file-icon">
                        <i class="fas fa-upload"></i>
                    </span>
                    <span class="file-label">
                        Import file...
                    </span>
                </span>
                </label>
            </div>
            <!--  <input type="file" @change="loadFile" multiple accept="application/json" > -->
        </div>
        <div style="margin-top: 1rem;" v-if="files">
            <label for="selectLang">Select JSON file</label>
            <select v-model="selected" id="selectLang">
                <option v-bind:value="file" v-for="file in parsedFiles" :key="file.lang">{{ file.lang }}</option>
            </select>
        </div>
    <!--    <div v-if="selected">
        <ul>
            <ExportJson :storageObj="selected.data" :fileName="ime + '-' +  language + '.json'"></ExportJson>
            <input type="text" name="name" id="" v-model="ime" style="width: 150px" class="input is-small" placeholder="Name of file">
            <select class="select is-small" name="language" v-model="language">

                <option :value="language.code" v-for="language in languages" >{{language.code}}</option>

            </select>
            <div v-for="(value, key) in selected.data" :key="key" style="text-align: left">
                <label style="color: red">{{ key }}</label>:
                &lt;!&ndash;<label style="color: green; border:1px solid black;margin-right: 45px" >{{ value }}</label>&ndash;&gt;
                <input type="text" :value="value">

            </div>
        </ul>
    </div>-->

        <div class="modal is-active" v-if="selected">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">JSON</p>
                    <button class="delete" aria-label="close" @click="selected = null"></button>
                </header>

                <section class="modal-card-body">
                    <div v-for="(value, key) in selected.data" :key="key" style="text-align: left">
                        <label style="color: red; margin-bottom: auto">{{ key }}:</label>
                        <input type="text" :value="value" class="input is-success">

                    </div>

                </section>
                <footer class="modal-card-foot">

                    <ExportJson :storageObj="selected.data" :fileName="ime + '-' +  language + '.json'" v-if="this.inputs != '' && this.ime != ''"></ExportJson>
                    <button class="button is-link" v-if="this.inputs != '' && this.ime != ''">Save</button>
                    <input type="text" name="name" id="" v-model="ime" style="width: 150px" class="input is-small" placeholder="Name of file">


                    <select class="select is-small" name="language" v-model="language">

                        <option :value="language.code" v-for="language in languages" >{{language.code}}</option>

                    </select>





                </footer>
            </div>
        </div>
    </div>


</template>
<script>
    import ExportJson from "./ExportJson.vue";
    export default {
        components: {ExportJson},
        data() {
            return {
                parsedFiles: [],
                files: null,
                selected: null,
                languages: [],
                language:'en',
                ime: '',
                newJSON: null
            };
        },
        methods: {
            loadFile(event) {
                this.files = event.target.files;
                if (!this.files || this.files.length === 0) return;
                this.selected = null;
                this.parsedFiles = [];
                [...this.files].forEach(file => {
                    let reader = new FileReader();
                    reader.onload = () => this.parsedFiles.push({
                        lang: file.name,
                        data: JSON.parse(reader.result)
                    });
                    reader.readAsText(file);
                })
            }
        },
        created() {
            axios.get('./api/language').then(response => this.languages = response.data);
        }
    }
</script>