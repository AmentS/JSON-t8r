<template>
    <div class="Translate">
        <h1>Molimo odaberite JSON file</h1>
        <div>
            <div class="file">
                <label class="file-label">
                    <input class="file-input" type="file" name="resume" @change="loadFile" multiple accept="application/json">
                    <span class="file-cta">
                    <span class="file-icon">
                        <i class="fas fa-upload"></i>
                    </span>
                    <span class="file-label">
                        Odaberite file...
                    </span>
                </span>
                </label>
            </div>
            <!--  <input type="file" @change="loadFile" multiple accept="application/json" > -->
        </div>
        <div style="margin-top: 1rem;" v-if="files">
            <label for="selectLang">Izaberite jezik</label>
            <select v-model="selected" id="selectLang">
                <option v-bind:value="file" v-for="file in parsedFiles" :key="file.lang">{{ file.lang }}</option>
            </select>
        </div>
        <div v-if="selected">
            <ul>
                <ExportJson :storageObj="selected.data" :fileName="selected.lang"></ExportJson>
                <div v-for="(value, key) in selected.data" :key="key" style="text-align: left">
                    <label style="color: red">{{ key }}</label>:<label style="color: green; border:1px solid black;margin-right: 45px" >{{ value }}</label>
                    <input type="text" placeholder="Value in new language">
                </div>
            </ul>
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
                selected: {}
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
        }
    }
</script>