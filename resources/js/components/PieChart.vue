<template>
    <div id="piechart">
    </div>
</template>

<script>

    var Highcharts = require('highcharts');
    export default {
        name : "pie-chart",
        series: [],

        data() {
            return {
                chart: undefined,
                seriesData: [],
                xAxis : []
            }
        },
        mounted () {
            this.getData();

        },
        beforeDestroy: function() {
            this.target.destroy();
        },
        methods: {
            getData(){
                axios.get('/api/failSmsApi',
                    {
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    }
                )
                    .then(({ data })=> {
                        console.log("data", data);
                        let chartdata =  data['chartData'];
                        this.seriesData = [];

                        // creating the appropriate  data format for pie chart
                        for (let i = 0; i < chartdata.length; i++){
                            this.seriesData[i]= {
                                name :"API " + chartdata[i]['api'],
                                y : chartdata[i]['total']
                            }
                        }
                       // this.xAxis = ['Api 1', 'Api 2'];

                        this.setChart();
                    })
                    .catch((err)=> {
                        console.log("error:", err);
                    })

            },
            setChart(){
                this.chart = Highcharts.chart('piechart', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: ' The percentage of the failed Api'
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: false
                            },
                            showInLegend: true
                        }
                    },
                    series: [{
                        name: 'Steps',
                        colorByPoint: true,
                        data: this.seriesData
                    }]
                });
            }
        }
    }

</script>

<style scoped>

</style>