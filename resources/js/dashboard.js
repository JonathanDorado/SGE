var theme;
var data_total_events_by_state;
var data_total_assistants_by_events;
var total_payment_arl;
var total_payment_person;
var total_payment_scholarship;
var total_payment_company;
var total_events_by_month;

$(document).ready(function () {

    setupCharts();
    if ($("#event_id").val() != undefined) {
        var event_id = $("#event_id").val();
        chartProjections(event_id);
        chartPaymentTypes(event_id);
    } else {
        chartEventsByMonth();
    }

//    console.log(data_total_assistants_by_events);
//    var bar_data = {
////        data: [['January', 10], ['February', 8], ['March', 4], ['April', 13], ['May', 17], ['June', 9]],
//        data: data_total_assistants_by_events,
//        color: '#3c8dbc'
//    }



//    $.plot('#graphic_events_by_state', data_total_events_by_state, {
//        series: {
//            pie: {
//                show: true,
//                radius: 1,
//                innerRadius: 0.5,
//                label: {
//                    show: true,
//                    radius: 2 / 3,
//                    formatter: labelFormatter,
//                    threshold: 0.1
//                }
//
//            }
//        },
//        legend: {
//            show: false
//        }
//    });

});

function chargeResumeEvents(id) {
    var year = $("#" + id + " option:selected").val();
    chartEventsByMonth(year);
}

function setupCharts() {
    theme = {
        color: [
            '#26B99A', '#34495E', '#BDC3C7', '#3498DB',
            '#9B59B6', '#8abb6f', '#759c6a', '#bfd3b7'
        ],

        title: {
            itemGap: 8,
            textStyle: {
                fontWeight: 'normal',
                color: '#408829'
            }
        },

        dataRange: {
            color: ['#1f610a', '#97b58d']
        },

        toolbox: {
            color: ['#408829', '#408829', '#408829', '#408829']
        },

        tooltip: {
            backgroundColor: 'rgba(0,0,0,0.5)',
            axisPointer: {
                type: 'line',
                lineStyle: {
                    color: '#408829',
                    type: 'dashed'
                },
                crossStyle: {
                    color: '#408829'
                },
                shadowStyle: {
                    color: 'rgba(200,200,200,0.3)'
                }
            }
        },

        dataZoom: {
            dataBackgroundColor: '#eee',
            fillerColor: 'rgba(64,136,41,0.2)',
            handleColor: '#408829'
        },
        grid: {
            borderWidth: 0
        },

        categoryAxis: {
            axisLine: {
                lineStyle: {
                    color: '#408829'
                }
            },
            splitLine: {
                lineStyle: {
                    color: ['#eee']
                }
            }
        },

        valueAxis: {
            axisLine: {
                lineStyle: {
                    color: '#408829'
                }
            },
            splitArea: {
                show: true,
                areaStyle: {
                    color: ['rgba(250,250,250,0.1)', 'rgba(200,200,200,0.1)']
                }
            },
            splitLine: {
                lineStyle: {
                    color: ['#eee']
                }
            }
        },
        timeline: {
            lineStyle: {
                color: '#408829'
            },
            controlStyle: {
                normal: {color: '#408829'},
                emphasis: {color: '#408829'}
            }
        },

        k: {
            itemStyle: {
                normal: {
                    color: '#68a54a',
                    color0: '#a9cba2',
                    lineStyle: {
                        width: 1,
                        color: '#408829',
                        color0: '#86b379'
                    }
                }
            }
        },
        map: {
            itemStyle: {
                normal: {
                    areaStyle: {
                        color: '#ddd'
                    },
                    label: {
                        textStyle: {
                            color: '#c12e34'
                        }
                    }
                },
                emphasis: {
                    areaStyle: {
                        color: '#99d2dd'
                    },
                    label: {
                        textStyle: {
                            color: '#c12e34'
                        }
                    }
                }
            }
        },
        force: {
            itemStyle: {
                normal: {
                    linkStyle: {
                        strokeColor: '#408829'
                    }
                }
            }
        },
        chord: {
            padding: 4,
            itemStyle: {
                normal: {
                    lineStyle: {
                        width: 1,
                        color: 'rgba(128, 128, 128, 0.5)'
                    },
                    chordStyle: {
                        lineStyle: {
                            width: 1,
                            color: 'rgba(128, 128, 128, 0.5)'
                        }
                    }
                },
                emphasis: {
                    lineStyle: {
                        width: 1,
                        color: 'rgba(128, 128, 128, 0.5)'
                    },
                    chordStyle: {
                        lineStyle: {
                            width: 1,
                            color: 'rgba(128, 128, 128, 0.5)'
                        }
                    }
                }
            }
        },
        gauge: {
            startAngle: 225,
            endAngle: -45,
            axisLine: {
                show: true,
                lineStyle: {
                    color: [[0.2, '#86b379'], [0.8, '#68a54a'], [1, '#408829']],
                    width: 8
                }
            },
            axisTick: {
                splitNumber: 10,
                length: 12,
                lineStyle: {
                    color: 'auto'
                }
            },
            axisLabel: {
                textStyle: {
                    color: 'auto'
                }
            },
            splitLine: {
                length: 18,
                lineStyle: {
                    color: 'auto'
                }
            },
            pointer: {
                length: '90%',
                color: 'auto'
            },
            title: {
                textStyle: {
                    color: '#333'
                }
            },
            detail: {
                textStyle: {
                    color: 'auto'
                }
            }
        },
        textStyle: {
            fontFamily: 'Arial, Verdana, sans-serif'
        }
    };
}

function chartEventsByMonth(year) {
    $("#graph_events_by_month").html("");
    if (year === "" || year === undefined) {
        year = new Date().getFullYear();
    }

    $.post("dashboard/getDataEventsByMonth", {year: year}, function (response) {
        var data = JSON.parse(response);
        if ($('#graph_events_by_month').length) {
            Morris.Bar({
                element: 'graph_events_by_month',
                data: data.data,
                xkey: 'month',
                ykeys: ['total'],
                labels: ['Total Eventos'],
                barRatio: 0.4,
                barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
                xLabelAngle: 35,
                hideHover: 'auto',
                resize: true
            });
        }
    });
}

function chartProjections(event_id) {

    $.post("getDataProjectionsByEvent", {event_id: event_id}, function (response) {
        var data = JSON.parse(response);
        if ($('#graph_projections').length) {

            var ctx = document.getElementById("graph_projections");
            var mybarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["Invitados", "Pre-registrados", "Confirmados", "Asistentes"],
                    datasets: [{
                            label: 'Proyección',
                            backgroundColor: "#26B99A",
                            data: data.data_projection
                        }, {
                            label: 'Real',
                            backgroundColor: "#03586A",
                            data: data.data_real
                        }]
                },

                options: {
                    scales: {
                        yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                    }
                }
            });
        }
    });
}

function chartPaymentTypes(event_id) {
    $.post("getDataPaymentTypes", {event_id: event_id}, function (response) {
        var data = JSON.parse(response);
        if ($('#echart_pie').length) {

            var echartPie = echarts.init(document.getElementById('echart_pie'), theme);

            echartPie.setOption({
                tooltip: {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                legend: {
                    x: 'center',
                    y: 'bottom',
                    data: ['ARL', 'Persona Natural', 'Beca', 'Empresa']
                },
                toolbox: {
                    show: true,
                    feature: {
                        magicType: {
                            show: true,
                            type: ['pie', 'funnel'],
                            option: {
                                funnel: {
                                    x: '25%',
                                    width: '50%',
                                    funnelAlign: 'left',
                                    max: 1548
                                }
                            }
                        },
                        saveAsImage: {
                            show: true,
                            title: "Guardar Imagen"
                        }
                    }
                },
                calculable: true,
                series: [{
                        name: 'Tipos de Pago',
                        type: 'pie',
                        radius: '55%',
                        center: ['50%', '48%'],
                        data: [{
                                value: data.payment_arl[0].total,
                                name: 'ARL'
                            }, {
                                value: data.payment_person[0].total,
                                name: 'Persona Natural'
                            }, {
                                value: data.payment_scholarship[0].total,
                                name: 'Beca'
                            }, {
                                value: data.payment_company[0].total,
                                name: 'Empresa'
                            }]
                    }]
            });

            var dataStyle = {
                normal: {
                    label: {
                        show: false
                    },
                    labelLine: {
                        show: false
                    }
                }
            };

            var placeHolderStyle = {
                normal: {
                    color: 'rgba(0,0,0,0)',
                    label: {
                        show: false
                    },
                    labelLine: {
                        show: false
                    }
                },
                emphasis: {
                    color: 'rgba(0,0,0,0)'
                }
            };

        }
    });


}

function labelFormatter(label, series) {
    return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
            + label
            + '<br>'
            + Math.round(series.percent) + '%</div>'
}

/////////////Redirect to event dashboard//////////////////////////////////////////////////
function show_event_dashboard(called_from) {
    var event_id = $("#event_dashboard").val();
    if (event_id != "") {
        if (called_from == 1) {//Called from dashboard platform
            $.redirect('dashboard/index_event', {event_id: event_id});
        } else {//Called from dashboard event
            $.redirect('../dashboard/index_event', {event_id: event_id});
        }
    }else{
        return false;
    }

}
