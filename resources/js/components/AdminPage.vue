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
                        <tr  style="text-align: center"><td><b>Problem</b></td><td><b>Description</b></td><td><b>User</b></td></tr>


                        <tr v-for="c in contacts" :key="c.id" style="text-align: center">
                            <td>{{c.problem}}</td>
                            <td>{{c.description}}</td>
                            <td>{{c.user.name}}</td>

                        </tr>

                    </table>
                </div>


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

