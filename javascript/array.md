* 5 Array Methods That You Should Be Using Now
  * http://colintoh.com/blog/5-array-methods-that-you-should-use-today?utm_source=javascriptweekly&utm_medium=email

----

* indexOf

```
var arr = ['apple','orange','pear'];
console.log("found:", arr.indexOf("orange") != -1);
```

----

* filter 

```
var arr = [
    {"name":"apple", "count": 2}, {"name":"orange", "count": 5},
    {"name":"pear", "count": 3}, {"name":"orange", "count": 16},
];
var newArr = arr.filter(function(item){
    return item.name === "orange";
});
```

----

* forEach

````
// Uses the usual "for" loop to iterate
for(var i= 0, l = arr.length; i< l; i++){
	console.log(arr[i]);
}

console.log("========================");

//Uses forEach to iterate
arr.forEach(function(item,index){
	console.log(item);
});
````

----

* map

```
var oldArr = [{first_name:"Colin",last_name:"Toh"},{first_name:"Addy",last_name:"Osmani"},{first_name:"Yehuda",last_name:"Katz"}];
function getNewArr() {
    var newArr = [];
    for (var i= 0, l = oldArr.length; i< l; i++) {
        var item = oldArr[i];
        item.full_name = [item.first_name,item.last_name].join(" ");
        newArr[i] = item;
    }
    return newArr;
}
console.log(getNewArr());

var oldArr = [{first_name:"Colin",last_name:"Toh"},{first_name:"Addy",last_name:"Osmani"},{first_name:"Yehuda",last_name:"Katz"}];
function getNewArr(){
    return oldArr.map(function(item,index){
        item.full_name = [item.first_name,item.last_name].join(" ");
        return item;
    });
}
console.log(getNewArr());
```

----

* reduce

```
var arr = ["apple","orange","apple","orange","pear","orange"];
function getWordCnt(){
    var obj = {};
    for(var i= 0, l = arr.length; i< l; i++){
        var item = arr[i];
        obj[item] = (obj[item] +1 ) || 1;
    }
    return obj;
}
console.log(getWordCnt());

var arr = ["apple","orange","apple","orange","pear","orange"];
function getWordCnt(){
    return arr.reduce(function(prev,next) {
        prev[next] = (prev[next] + 1) || 1;
        return prev;
    },{});
}
console.log(getWordCnt());
```
