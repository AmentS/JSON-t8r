<template>
    <div class="container">

        <div class="container" style="text-align: center; margin-bottom: 10px">
            <p class="title" >System Overview</p>
            <GChart
                type="PieChart"
                :data="chartData"
                :options="chartOptions"
            />
        </div>


        <div class="container">
            <div class="columns">

                <div class="column is-one-third" >Korisnici</div>

                <div class="column">
               <table class="table table is-striped"  style="text-align: center">
                        <tr  style="text-align: center"><td><b>Problem</b></td><td><b>Description</b></td><td><b>User</b></td><td><b></b></td></tr>


                        <tr v-for="c in contacts" :key="c.id" style="text-align: center">
                            <td>{{c.problem}}</td>
                            <td>{{c.description}}</td>
                            <td>{{c.user.name}}</td>
                            <td><button class="button is-info" @click="openContacts(c.id), showModal = true">Open</button></td>


                        </tr>

                    </table>
                </div>


            </div>

        </div>

        <div class="modalis-active" v-show="showModal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">{{contactsOpen.problem}}</p>
                    <button class="delete" aria-label="close" @click="showModal = false"></button>
                </header>
                <section class="modal-card-body">
                    {{contactsOpen.description}}
                </section>
                <footer class="modal-card-foot">


                </footer>
            </div>
        </div>




    </div>




</template>

<script>
    export default {

        data() {

            return {
                usersOnProject: 0,
                contacts: [],
                contactsOpen: [],
                contactId: '',
                showModal: false
            }
        },
        methods: {
            async fetchUsers() {
                try {
                    const {data} = await axios.get(`./api/users`);
                    this.usersOnProject = data;

                } catch {

                }
            },
            async fetchContacts(){
                try {
                    const {data} = await axios.get(`./api/contact`);
                    this.contacts = data;

                } catch {

                }
            },
            async openContacts(a){
                try {
                    const {data} = await axios.get("/api/contact/" + a);
                    this.contactsOpen = data;

                }catch  {

                }
            }

        },
        created() {
            this.fetchUsers();
            this.fetchContacts();
        },
        computed: {
            chartData(){
                return {
                    chartData: [
                        ['Task', 'Hours per Day'],
                        ['Work',     11],
                        ['Eat',      2],
                        ['Commute',  2],
                        ['Watch TV', 2],
                        ['Sleep',    7]
                    ]

                }
            }

        }
    }



</script>

