<template>

    <GChart
        type="PieChart"
        :data="chartData"
        :options="chartOptions"
    />


</template>

<script>
    export default {
        data () {
            return {
                // Array will be automatically processed with visualization.arrayToDataTable function
                chartData: [
                    ['Task', 'Hours per Day'],
                    ['Work',     11],
                    ['Eat',      2],
                    ['Commute',  2],
                    ['Watch TV', 2],
                    ['Sleep',    7]
                ],
                chartOptions: {
                    chart: {
                        title: 'Company Performance',
                        subtitle: 'Sales, Expenses, and Profit: 2014-2017',
                    }
                }
            }
        }
    }



</script>

<style scoped>

</style>
