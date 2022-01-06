// Animation de la navbar normal et en Mobile.

const navbar = document.querySelector('.navbar')

navbar.querySelector('.toggle').addEventListener('click',()=>{
	
	navbar.classList.toggle('collapsed')
})



window.addEventListener('scroll',(e)=>{
	
	let windowY = window.pageYOffset
	
	let navbarHeight = document.querySelector('.navbar').offsetHeight
	
	if(windowY>navbarHeight) navbar.classList.add('sticky')
	else navbar.classList.remove('sticky')
})

// Animation pour l'entete de la selection de voiture 

const entete = document.querySelector('.headCardAuto')

const image = document.querySelector('.homePageCard')

const nouveau = document.querySelector('.new')

const ancien = document.querySelector('.old')

const imageNone = document.querySelector('.homePageCard2')

entete.querySelector('.old').addEventListener('click',()=>{
	image.style.display = 'none'
	nouveau.style.background = 'rgba(255, 255, 255, 0.06)'
	nouveau.style.color = 'rgba(255, 255, 255, 0.63)'
	ancien.style.background = 'white'
	ancien.style.color = 'black'
	imageNone.style.display = 'flex'
}
)

entete.querySelector('.new').addEventListener('click',()=>{
	image.style.display = 'flex'
	nouveau.style.background = 'white'
	nouveau.style.color = 'black'
	ancien.style.background = 'rgba(255, 255, 255, 0.06)'
	ancien.style.color = 'rgba(255, 255, 255, 0.63)'
	imageNone.style.display = 'none'
	image.transition = 'ease-out'
}
)



am5.ready(function() {

// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new("chartdiv");


// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
	am5themes_Animated.new(root)
]);


// Create chart
// https://www.amcharts.com/docs/v5/charts/xy-chart/
var chart = root.container.children.push(am5xy.XYChart.new(root, {
	panX: true,
	panY: true,
	wheelX: "panX",
	wheelY: "zoomX"
}));

// Add cursor
// https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
cursor.lineY.set("visible", false);


// Create axes
// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
var xRenderer = am5xy.AxisRendererX.new(root, { minGridDistance: 30 });
xRenderer.labels.template.setAll({
	rotation: -90,
	centerY: am5.p50,
	centerX: am5.p100,
	paddingRight: 15
});

var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
	maxDeviation: 0.3,
	categoryField: "month",
	renderer: xRenderer,
	tooltip: am5.Tooltip.new(root, {})
}));

var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
	maxDeviation: 0.3,
	renderer: am5xy.AxisRendererY.new(root, {})
}));


// Create series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
var series = chart.series.push(am5xy.ColumnSeries.new(root, {
	name: "Series 1",
	xAxis: xAxis,
	yAxis: yAxis,
	valueYField: "value",
	sequencedInterpolation: true,
	categoryXField: "month",
	tooltip: am5.Tooltip.new(root, {
	labelText:"{valueY}"
	})
}));

series.columns.template.setAll({ cornerRadiusTL: 5, cornerRadiusTR: 5 });
series.columns.template.adapters.add("fill", (fill, target) => {
	return chart.get("colors").getIndex(series.columns.indexOf(target));
});

series.columns.template.adapters.add("stroke", (stroke, target) => {
	return chart.get("colors").getIndex(series.columns.indexOf(target));
});


// Set data
var data = [{
	month : "Janvier",
	value: 280
}, {
	month: "Fevrier",
	value: 390
}, {
	month: "Mars",
	value: 290
}, {
	month: "Avril",
	value: 290
}, {
	month: "Mai",
	value: 470
}, {
	month: "Juin",
	value: 410
}, {
	month: "Juillet",
	value: 620
}, {
	month: "Aout",
	value: 580
}, {
	month: "Septembre",
	value: 480
}, {
	month: "Octobre",
	value: 400
}, {
	month: "Novembre",
	value: 380
}, {
	month: "Decembre",
	value: 420
}];

xAxis.data.setAll(data);
series.data.setAll(data);


// Make stuff animate on load
// https://www.amcharts.com/docs/v5/concepts/animations/
series.appear(1000);
chart.appear(1000, 100);

}); // end am5.ready()

