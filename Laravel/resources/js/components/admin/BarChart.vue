<script>
    import {Bar} from 'vue-chartjs'

    export default {
        extends: Bar,
        props: {
            data: {
                type: Object,
                default: null,
            },
            options: {
                type: Object,
                default: null,
            }
        },
        mounted() {
            this.renderChart(this.data, {
                responsive: true, // my new default options
                maintainAspectRatio: false, // my new default options
                legend: {
                    onClick: (e) => e.stopPropagation()
                },
                scales: {
                    lineWidth: 2,
                    color: 'rgba(0, 0, 0, 0.3)',
                    xAxes: [{
                        gridLines: {
                            lineWidth: 2,
                            color: 'rgba(0, 0, 0, 0.3)',
                        },
                        ticks: {
                            fontColor: '#ffffff',
                            fontSize: 14,
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            lineWidth: 2,
                            color: 'rgba(0, 0, 0, 0.3)',
                        },
                    }],
                },
            });
        }
    }
</script>

<style scoped>
    #bar-chart {
        border-color: #661913;
    }
</style>