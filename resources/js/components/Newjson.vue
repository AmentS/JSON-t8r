<template>
    <div class="container">
        <div class="modal is-active" v-show="showModal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Novi JSON</p>
                    <button class="delete" aria-label="close" @click="showModal = false"></button>
                </header>

                <section class="modal-card-body">
                    <div v-for="(input, index) in inputs" :key="index">
                        <input type="text" v-model="input.key" placeholder="key" class="input is-success"
                               style="margin-bottom: 5px">
                        <input type="text" v-model="input.value" placeholder="value" class="input is-success">
                        <button @click="deleteRow(index)" class="delete"style="margin-top: 2px">Delete</button>
                        <label style="color: darkgray">{{ input.key }}</label> :
                        <label style="color: lightseagreen">{{ input.value }}</label>
                    </div>

                </section>
                <footer class="modal-card-foot">
                    <ExportJson :storageObj="inputsAsObject" :fileName="ime + '-' +  language + '.json'"></ExportJson>
                    <button @click="addRow" class="button is-primary">Add row</button>
                    <button @click="deleteAll" class="button is-danger">Delete all</button>
                    <button class="button is-link" @click="sauvaj">Save</button>
                    <input type="text" name="name" id="" v-model="ime" style="width: 150px" class="input is-small" placeholder="Name of file">

                  <select class="select is-small" name="language" v-model="language">

                      <option :value="language.code" v-for="language in languages" >{{language.code}}</option>

                    </select>



                </footer>
            </div>
        </div>
        <ul style="text-align: left">

            Kliknite ovde da bi ste kreirani no json
            <button @click="showModal = true">Kreiraj novi</button>
        </ul>

    </div>
</template>
<script>
    import ExportJson from "./ExportJson.vue";

    export default {
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
            sauvaj(){


                return JSON.stringify(Object.fromEntries(this.inputs.map(x => [x.key, x.value])));
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