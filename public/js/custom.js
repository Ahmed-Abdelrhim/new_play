document.querySelector('h3').style.color="blue";
console.log( 'Type Of Null => ' + typeof(null) ) ;
// => object

console.log('Converting String To Number => ' + +'ahmed'); //NaN
console.log(parseFloat('50 asdasdwesd'));
let myName = "ahmed";
console.log(myName.repeat(5) );


//it means the function takes a param
function printName(azzam) {
    if(azzam === 'ahmed')
        return true;
    console.log('From Function => ' + azzam);
}

//function calling
printName(myName);
