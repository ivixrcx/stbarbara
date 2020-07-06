Autocomplete
======
[![Latest Stable Version](https://poser.pugx.org/iviarco/jquery-autocomplete/v/stable)](https://packagist.org/packages/iviarco/jquery-autocomplete)
[![Total Downloads](https://poser.pugx.org/iviarco/jquery-autocomplete/downloads)](https://packagist.org/packages/iviarco/jquery-autocomplete)
[![Latest Unstable Version](https://poser.pugx.org/iviarco/jquery-autocomplete/v/unstable)](https://packagist.org/packages/iviarco/jquery-autocomplete)
[![License](https://poser.pugx.org/iviarco/jquery-autocomplete/license)](https://packagist.org/packages/iviarco/jquery-autocomplete)

***Autocomplete*** makes it so easy for you to manipulate input dropdown and fetch data that returns ***`jQuery promise`***. Autocomplete is based in ***`jQuery ^3`*** and ***`ES6 syntax`***.

## Features

 * handles data in array format
 * returns jQuery promise if uses ***`post("data.json")`*** method


## Install with composer

To install with [Composer](https://getcomposer.org/), simply require the
latest version of this package.

```bash
composer require iviarco/jquery-autocomplete
```

## Quick Start

**HTML**
```html
<div class="autocomplete">
	<input type="text" id="input" name="input" placeholder="Search" aria-label="Search"/>
</div>
```

**Javascript**


```js
// option 1
// instantiate with args $('#input') and Data
let ac = new autocomplete($('#input'), [
	{id: 1, data: 'test1'},
	{id: 2, data: 'test2'},
	{id: 3, data: 'test3'},
	{id: 4, data: 'test4'},
	{id: 5, data: 'test5'},
	{id: 6, data: 'test6'},
]);
```

```js
// option 2
// instantiate with $('#input')
let ac = new autocomplete($('#input'));

// post request
ac.post('/material.json')

// jQuery promise
.then(res=>{
	let list = [];
    
    // populate list[];
	$.each(res.data, (e, data)=>{
		list.push({
			id: data.material_id,
			data: data.particular,
		});
	});
    
    // pass list[] to setData() that serves as the items for the dropdown.
	ac.setData(list);
});
```

A callback when item is selected.

```js 
 	ac.itemSelected((id, val, input)=>{
		 // do awesome here...
    });
```	