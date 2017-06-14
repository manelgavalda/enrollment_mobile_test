<template>
    <div>
        <canvas ref="canvas"></canvas>
        <!--Controlar que novingui de dades de l'usuari-->
        <div v-html="legend"></div>
    </div>
</template>

<script>
    require('chart.js')
    export default {
//        props: ['labels', 'values', 'color'],
        data () {
            return {
                legend: '',
                dataValues: [],
                dataLabels: []
            }
        },
        props: {
            labels: {
                type: Array,
                default_values: ['January', 'February', 'March', 'April', 'May', 'June', 'July']
            },
            values: {
                type: Array,
                default_values: [10, 42, 4, 23, 43, 54]
            },
            url : {
                type: String
            }
        },
        methods: {
            render() {
                console.log('**************** RENDER ')
                let data = {
                    labels: this.dataLabels ,
                    datasets: [
                        {
                            label: "Enrollments",
                            fill: false,
                            lineTension: 0.1,
                            backgroundColor: this.color,
                            borderColor: "rgba(75,192,192,1)",
                            borderCapStyle: 'butt',
                            borderDash: [],
                            borderDashOffset: 0.0,
                            borderJoinStyle: 'miter',
                            pointBorderColor: "rgba(75,192,192,1)",
                            pointBackgroundColor: "#fff",
                            pointBorderWidth: 1,
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "rgba(75,192,192,1)",
                            pointHoverBorderColor: "rgba(220,220,220,1)",
                            pointHoverBorderWidth: 2,
                            pointRadius: 1,
                            pointHitRadius: 10,
                            data: this.dataValues,
                            spanGaps: false,
                        }
                    ]
                };
                console.log(this.$children)
                let context = this.$refs.canvas.getContext('2d')
                let chart= new Chart(context, {
                    type: 'bar',
                    data: data
                })
                this.legend = chart.generateLegend()
            }
        },
        mounted() {

            // Fetch API -> Standard Javascript per fer peticions AJAX a l'estil de promeses.

            var component = this
            //Fetch API -> Standard Javascript
            console.log('########## URL: ' + this.url)
            if (this.url) {
                fetch(this.url, {
                    method: 'get'
                }).then(function(response) {
                    console.log('########## PROVA: ' )
                    return response.json().then(function(json) {
                        // process your JSON further
                        console.log(json)
                        console.log(json.values)
                        console.log(json.labels)
                        component.dataValues = json.values
                        component.dataLabels = json.labels
                        component.render()
                    })
                }).catch(function(err) {
                    // Error :(
                    console.log('########## ERROR!!!!!!!!!!!!!!' )
                });
            } else {
                component.dataValues = this.values
                component.dataLabels = this.labels
                component.render()
            }

        }

    }
</script>
