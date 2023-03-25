"use strict";



function ownKeys(object,enumerableOnly){
    var keys=Object.keys(object);
    if(Object.getOwnPropertySymbols)
    {
        var symbols=Object.getOwnPropertySymbols(object);
        enumerableOnly&& (symbols=symbols.filter(function(sym){
            return Object.getOwnPropertyDescriptor(object,sym).enumerable})),keys.push.apply(keys,symbols)
    }
    return keys
}
function _objectSpread(target)
{
    for(var i=1;i<arguments.length;i++){
        var source=null !=arguments[i]?
            arguments[i]:{};i%2?
            ownKeys(Object(source),!0).forEach(function(key){
                _defineProperty(target,key,source[key])
            }):Object.getOwnPropertyDescriptors?
                Object.defineProperties(target,Object.getOwnPropertyDescriptors(source)) :
                ownKeys(Object(source)).forEach(function(key){
                    Object.defineProperty(target,key,Object.getOwnPropertyDescriptor(source,key)
                    )}
                    )}
    return target
}

function orders()
{
    var order = '{{new DashboardService()}}'
}

function _defineProperty(obj,key,value)
{
    if(key in obj){
        Object.defineProperty(obj,key,{value:value,enumerable:true,configurable:true,writable:true})
    }
    else{
        obj[key]=value}return obj
        }
    $(function(){
    $("#widget-carousel").slick({rtl:$("html").attr("dir")==="rtl",asNavFor:"#widget-carousel-nav",slidesToShow:1,slidesToScroll:1,arrows:false});
    $("#widget-carousel-nav").slick({rtl:$("html").attr("dir")==="rtl",asNavFor:"#widget-carousel",slidesToShow:1,slidesToScroll:1,arrows:false,centerMode:true});
    var isDarkDefault=localStorage.getItem("theme-variant")=="dark";
    var themeVariantDefault=isDarkDefault?"dark":"light";
    var currency=new Intl.NumberFormat("en-US",{style:"currency",currency:"USD",minimumFractionDigits:0});
    var colors={blue:"#2196f3",green:"#4caf50",red:"#f44336",white:"#fff",black:"#424242"};
    var themeOptions={light:{theme:{mode:"light",palette:"palette1"}},dark:{theme:{mode:"dark",palette:"palette1"}}};
    var first = document.querySelector("#widget-chart-1").getAttribute('data-first')
    var second = document.querySelector("#widget-chart-1").getAttribute('data-second')
    var third = document.querySelector("#widget-chart-1").getAttribute('data-third')
    var forth = document.querySelector("#widget-chart-1").getAttribute('data-forth')
    var fifth = document.querySelector("#widget-chart-1").getAttribute('data-fifth')
    var sixth = document.querySelector("#widget-chart-1").getAttribute('data-sixth')
    var widgetChart1=new ApexCharts(document.querySelector("#widget-chart-1"),
        _objectSpread(_objectSpread({},themeOptions[themeVariantDefault]),
            {},
            {
                series:[{name:"orders",data:[first,second,third,forth,fifth,sixth]}],
                chart:{type:"area",height:300,background:"transparent",sparkline:{enabled:true}},
                fill:{type:"solid"},markers:{strokeColors:isDarkDefault?colors.black:colors.white},
                stroke:{show:false},
                tooltip:{marker:{show:false},
                    y:{formatter:function formatter(val){return val}}},
                xaxis:{categories:[
                        document.querySelector("#widget-chart-1").getAttribute('data-first_month'),
                        document.querySelector("#widget-chart-1").getAttribute('data-second_month'),
                        document.querySelector("#widget-chart-1").getAttribute('data-third_month'),
                        document.querySelector("#widget-chart-1").getAttribute('data-forth_month'),
                        document.querySelector("#widget-chart-1").getAttribute('data-fifth_month'),
                        document.querySelector("#widget-chart-1").getAttribute('data-sixth_month')
                    ],
                    crosshairs:{show:false}},
                responsive:[{breakpoint:576,options:{chart:{height:200}}}]}));

    var widgetChart6=new ApexCharts(document.querySelector("#widget-chart-6"),_objectSpread(_objectSpread({},themeOptions[themeVariantDefault]),{},{series:[{name:"Unique",data:[6400,4e3,7600,6200,9800,6400,8600,7e3]}],chart:{type:"area",background:"transparent",height:300,sparkline:{enabled:true}},markers:{strokeColors:isDarkDefault?colors.black:colors.white},fill:{type:"gradient",gradient:{shade:themeVariantDefault,type:"vertical",opacityFrom:1,opacityTo:0,stops:[0,100]}},tooltip:{marker:{show:false},y:{formatter:function formatter(val){return"".concat(val," Visited")}}},xaxis:{categories:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug"],crosshairs:{show:false}}}));var widgetChart7=$(".widget-chart-7").map(function(){var color=$(this).data("chart-color");var label=$(this).data("chart-label");var series=$(this).data("chart-series").split(",").map(function(data){return Number(data)});var enabledCurrency=$(this).data("chart-currency");return new ApexCharts(this,_objectSpread(_objectSpread({},themeOptions[themeVariantDefault]),{},{series:[{name:label,data:series}],chart:{type:"area",height:200,background:"transparent",sparkline:{enabled:true}},fill:{type:"solid",colors:[color],opacity:.1},stroke:{show:true,colors:[color]},markers:{colors:isDarkDefault?colors.black:colors.white,strokeWidth:4,strokeColors:color},tooltip:{marker:{show:false},y:{formatter:function formatter(val){return Boolean(enabledCurrency)?currency.format(val):val}}},xaxis:{categories:["Jan","Feb","Mar","Apr","May","Jun"],crosshairs:{show:false}}}))});widgetChart1.render();widgetChart6.render();widgetChart7.each(function(){this.render()});$("#theme-toggle").on("click",function(){var isDark=$("body").hasClass("theme-dark");var themeVariant=isDark?"dark":"light";widgetChart1.updateOptions(_objectSpread(_objectSpread({},themeOptions[themeVariant]),{},{markers:{strokeColors:isDark?colors.black:colors.white}}));widgetChart6.updateOptions(_objectSpread(_objectSpread({},themeOptions[themeVariant]),{},{markers:{strokeColors:isDark?colors.black:colors.white},fill:{gradient:{shade:themeVariant}}}));widgetChart7.each(function(){this.updateOptions(_objectSpread(_objectSpread({},themeOptions[themeVariant]),{},{markers:{colors:isDark?colors.black:colors.white}}))})})});
