<template>
    <div class="container">
        <div class="modal is-active" v-show="showModal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">New JSON</p>
                    <button class="delete" aria-label="close" @click="showModal = false"></button>
                </header>

                <section class="modal-card-body">
                    <div v-for="(input, index) in inputs" :key="index">
                        <input type="text" v-model="input.key" placeholder="key" class="input is-success"
                               style="margin-bottom: 5px;">
                        <input type="text" v-model="input.value" placeholder="value" class="input is-success" >
                        <button @click="deleteRow(index)" class="delete"style=" margin-top: 2px;">Delete</button>
                        <!--left: -15px;top: -10px;position: relative;-->
                        <label style="color: darkgray">{{ input.key }}</label> :
                        <label style="color: lightseagreen">{{ input.value }}</label>
                    </div>

                </section>
                <footer class="modal-card-foot">

                    <ExportJson :storageObj="inputsAsObject" :fileName="ime + '-' +  language + '.json'" v-if="this.inputs != '' && this.ime != ''"></ExportJson>
                    <button @click="addRow" class="button is-primary">Add row</button>
                    <button @click="deleteAll" class="button is-danger">Delete all</button>
                    <button class="button is-link" @click="sacuvaj" v-if="this.inputs != '' && this.ime != ''">Save</button>
                    <input type="text" name="name" id="" v-model="ime" style="width: 150px" class="input is-small" placeholder="Name of file">

                    <select class="select is-small" name="language" v-model="language">

                        <option :value="language.code" v-for="language in languages" >{{language.code}}</option>

                    </select>



                </footer>
            </div>
        </div>

    <div> <h1>Create new JSON file</h1> <button @click="showModal = true" class="button is-success">Crete new</button></div>







    </div>
</template>
<script>
    import ExportJson from "./ExportJson.vue";

    export default {
        props: ['projectId'],
        components: {ExportJson},
        data() {
            return {
                inputs: [],
                ime: '',
                showModal: false,
                languages: [],
                language:'en'
            };
        },
        methods: {
            addRow() {
                this.inputs.push({
                    key: '',
                    value: ''
                });
            },
            deleteRow(index) {
                this.inputs.splice(index, 1)
            },
            deleteAll() {
                this.inputs = [];
            },
            async sacuvaj(){
                const data = JSON.stringify(this.inputsAsObject);

                try {
                    const response = await axios.post('/api/translations/', {
                        'project_id': this.projectId,
                        'language_code': this.language,
                        'filename': this.ime,
                        data
                    });

                    Swal.fire({icon: 'success', text:"Translation saved"});
                } catch(e) {
                    Swal.fire({icon: 'error', text: "Oops, something went wrong, try again in a few seconds"});
                }finally{
                    this.inputs = [];
                    this.ime = '';
                }

            }


        },
        computed: {
            inputsAsObject() {

                return Object.fromEntries(this.inputs.map(x => [x.key, x.value]));
            }
        },
        created() {
            axios.get('./api/language').then(response => this.languages = response.data);
        }
    }
</script>
