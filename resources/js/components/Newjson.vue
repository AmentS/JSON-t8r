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
                        <button @click="deleteRow(index)" class="delete">Delete</button>
                        {{ input.key }} :
                        {{ input.value }}
                    </div>

                </section>
                <footer class="modal-card-foot">
                    <ExportJson :storageObj="inputsAsObject" :fileName="ime + '.json'"></ExportJson>
                    <button @click="addRow" class="button is-primary">Add row</button>
                    <button @click="deleteAll" class="button is-danger">Delete all</button>
                    <input type="text" placeholder="Jezik" v-model="ime">
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
            }
        },
        computed: {
            inputsAsObject() {
                return Object.fromEntries(this.inputs.map(x => [x.key, x.value]));
            }
        }
    }
</script>