var options = {
    series: [100],
    grid: {
        padding: {
            top: 0,
            right: 0,
            bottom: 0,
            left: 0
        },
    },
    chart: {
        height: 100,
        width: 70,
        type: 'radialBar',
    },
    plotOptions: {
        radialBar: {
            hollow: {
                size: '50%',
            },
            dataLabels: {
                name: {
                    show: false,
                    color: '#fff'
                },
                value: {
                    show: true,
                    color: '#333',
                    offsetY: 5,
                    fontSize: '15px'
                }
            }
        }
    },
    colors: ['#ecf0f4'],
    fill: {
        type: 'gradient',
        gradient: {
            shade: 'dark',
            type: 'diagonal1',
            shadeIntensity: 0.8,
            gradientToColors: ['#1b00ff'],
            inverseColors: false,
            opacityFrom: [1, 0.2],
            opacityTo: 1,
            stops: [0, 100],
        }
    },
    states: {
        normal: {
            filter: {
                type: 'none',
                value: 0,
            }
        },
        hover: {
            filter: {
                type: 'none',
                value: 0,
            }
        },
        active: {
            filter: {
                type: 'none',
                value: 0,
            }
        },
    }
};
var s1Total = document.getElementById("s1");
var s2 = document.getElementById("s2");
var options2 = {
    series: [Math.round((s2.innerHTML / s1Total.innerHTML) * 100)],
    grid: {
        padding: {
            top: 0,
            right: 0,
            bottom: 0,
            left: 0
        },
    },
    chart: {
        height: 100,
        width: 70,
        type: 'radialBar',
    },
    plotOptions: {
        radialBar: {
            hollow: {
                size: '50%',
            },
            dataLabels: {
                name: {
                    show: false,
                    color: '#fff'
                },
                value: {
                    show: true,
                    color: '#333',
                    offsetY: 5,
                    fontSize: '15px'
                }
            }
        }
    },
    colors: ['#ecf0f4'],
    fill: {
        type: 'gradient',
        gradient: {
            shade: 'dark',
            type: 'diagonal1',
            shadeIntensity: 1,
            gradientToColors: ['#009688'],
            inverseColors: false,
            opacityFrom: [1, 0.2],
            opacityTo: 1,
            stops: [0, 100],
        }
    },
    states: {
        normal: {
            filter: {
                type: 'none',
                value: 0,
            }
        },
        hover: {
            filter: {
                type: 'none',
                value: 0,
            }
        },
        active: {
            filter: {
                type: 'none',
                value: 0,
            }
        },
    }
};

var s3 = document.getElementById("s3");
var options3 = {
    series: [Math.round((s3.innerHTML / s1Total.innerHTML) * 100)],
    grid: {
        padding: {
            top: 0,
            right: 0,
            bottom: 0,
            left: 0
        },
    },
    chart: {
        height: 100,
        width: 70,
        type: 'radialBar',
    },
    plotOptions: {
        radialBar: {
            hollow: {
                size: '50%',
            },
            dataLabels: {
                name: {
                    show: false,
                    color: '#fff'
                },
                value: {
                    show: true,
                    color: '#333',
                    offsetY: 5,
                    fontSize: '15px'
                }
            }
        }
    },
    colors: ['#ecf0f4'],
    fill: {
        type: 'gradient',
        gradient: {
            shade: 'dark',
            type: 'diagonal1',
            shadeIntensity: 0.8,
            gradientToColors: ['#f56767'],
            inverseColors: false,
            opacityFrom: [1, 0.2],
            opacityTo: 1,
            stops: [0, 100],
        }
    },
    states: {
        normal: {
            filter: {
                type: 'none',
                value: 0,
            }
        },
        hover: {
            filter: {
                type: 'none',
                value: 0,
            }
        },
        active: {
            filter: {
                type: 'none',
                value: 0,
            }
        },
    }
};


var chart = new ApexCharts(document.querySelector("#statistic1"), options);
chart.render();

var chart2 = new ApexCharts(document.querySelector("#statistic2"), options2);
chart2.render();

var chart3 = new ApexCharts(document.querySelector("#statistic3"), options3);
chart3.render();



// datatable init
$('document').ready(function () {
    $('.data-table').DataTable({
        scrollCollapse: true,
        autoWidth: true,
        responsive: true,
        searching: false,
        bLengthChange: false,
        bPaginate: false,
        bInfo: false,
        columnDefs: [{
            targets: "datatable-nosort",
            orderable: false,
        }],
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        "language": {
            "info": "_START_-_END_ of _TOTAL_ entries",
            searchPlaceholder: "Search",
            paginate: {
                next: '<i class="ion-chevron-right"></i>',
                previous: '<i class="ion-chevron-left"></i>'
            }
        },
    });
});
