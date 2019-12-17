var rootStyle = getComputedStyle(document.body);

var themeColor1 = rootStyle.getPropertyValue("--theme-color-1").trim();
var themeColor2 = rootStyle.getPropertyValue("--theme-color-2").trim();
var themeColor3 = rootStyle.getPropertyValue("--theme-color-3").trim();
var themeColor4 = rootStyle.getPropertyValue("--theme-color-4").trim();
var themeColor5 = rootStyle.getPropertyValue("--theme-color-5").trim();
var themeColor6 = rootStyle.getPropertyValue("--theme-color-6").trim();
var themeColor1_10 = rootStyle
    .getPropertyValue("--theme-color-1-10")
    .trim();
var themeColor2_10 = rootStyle
    .getPropertyValue("--theme-color-2-10")
    .trim();
var themeColor3_10 = rootStyle
    .getPropertyValue("--theme-color-3-10")
    .trim();
var themeColor4_10 = rootStyle
    .getPropertyValue("--theme-color-4-10")
    .trim();

var themeColor5_10 = rootStyle
    .getPropertyValue("--theme-color-5-10")
    .trim();
var themeColor6_10 = rootStyle
    .getPropertyValue("--theme-color-6-10")
    .trim();

let chartTooltip = {
    backgroundColor: rootStyle.getPropertyValue("--foreground-color").trim(),
    titleFontColor: rootStyle.getPropertyValue("--primary-color").trim(),
    borderColor: rootStyle.getPropertyValue("--separator-color").trim(),
    borderWidth: 0.5,
    bodyFontColor: rootStyle.getPropertyValue("--primary-color").trim(),
    bodySpacing: 10,
    xPadding: 15,
    yPadding: 15,
    cornerRadius: 0.15,
    displayColors: false
};


function initCharts(chartId , data) {
    let chart = document.getElementById(chartId);
    return new Chart(chart, {
        type: "polarArea",
        data: data,
        draw: function () { },
        options: {
            plugins: {
                datalabels: {
                    display: false
                }
            },
            responsive: true,
            maintainAspectRatio: false,
            scale: {
                ticks: {
                    display: false
                }
            },
            legend: {
                position: "bottom",
                labels: {
                    padding: 30,
                    usePointStyle: true,
                    fontSize: 12
                }
            },
            tooltips: chartTooltip
        },
    });

}
