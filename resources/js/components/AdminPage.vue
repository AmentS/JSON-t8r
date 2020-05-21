<template>
    <div class="container">
        <div class="container" style="text-align: center">
            <p class="title" >System Overview</p>
            <GChart
                type="PieChart"
                :data="chartData"
            />
        </div>
        <div class="container">
        <div class="columns" style="border: 1px solid red; height: 50px" >

            <div class="column is-one-third" style="text-align: center; border: 1px solid black; height: 50px"> Korisnici</div>

            <div class="column" style="text-align: center; border: 1px solid black; height: 50px"> Poruke</div>


        </div>
    </div>



    </div>


</template>

<script>
    export default {

        data() {

            return {
                usersOnProject: 0


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

        },
        created() {
            this.fetchUsers();
        },
        computed: {
            chartData(){
                return {
                    chartData: [
                        ['Users', this.usersOnProject],
                        ['Projects', 3],
                        ['Translations', 1],
                        ['Messages', 2],
                    ]

                }
            }

        }
    }



</script>

