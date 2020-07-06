/**
*
* simplified JQUERY autocomplete ES6 version
* version 2.1.0
*/
  
class autocomplete {
  
    constructor(input, data=''){
        this._data = data;
        this._input = input[0];
        this._items = [];
        this._promise = '';
        this._currentFocus = 0;
        this._hasData = false;
  
        // initialize key events
        this._oninput();
        this._onkeydown();
        this._onclick();
    }
  
    /*
    *   input keyup event
    */
    _oninput(){
        $(this._input).on('input', x=>{
            x.preventDefault();
            let list, listItem;
  
            let that = this;
            let input = x.target;
            let value = x.target.value;
            let id = x.target.id;
            // if value is empty stops here
            if(!value) return false;
  
            // close any open lists of autocomplete values
            this._closeAllLists();
  
            this._currentFocus = -1;
  
            // create a DIV element that will contain the items (values)
            list = $('<div>', {
                id: id + '-autocomplete-list',
                class: 'autocomplete-items',
            });
  
            // append the DIV element as a child of the autocomplete container: 
            $(input).parent().append(list);
 
            // clear this._items
            this._items = [];
  
            // for each item in the array...
            for (let i = 0; i < this._data.length; i++) {
  
                // check if the item starts with the same letters as the text field value:
                if(this._data[i].data.substr(0, value.length).toUpperCase() == value.toUpperCase()){
  
                    // create a DIV element for each matching element
                    listItem = $('<div/>');
                    let _list = this._data[i].list ? this._data[i].list : this._data[i].data;
                    $(listItem).append('<strong>' + _list.substr(0, value.length) + '</strong>');
                    $(listItem).append(_list.substr(value.length));
  
                    // insert a input field that will hold the current array item's value
                    $(listItem).append('<input type="hidden" data-id="' + this._data[i].id + '" value="' + (this._data[i].list ? this._data[i].list : this._data[i].data) + '">');
  
                    // excute a function when someone clicks on the item value (DIV element)
                    $(listItem).click(function(){
  
                        // insert the value for th autocomplete text field
                        $(input).data('id', $($(this).children()[1]).data('id'));
                        $(input).val($(this).children()[1].value)
                          
                        // close the list of autocompleted values,
                        // (or any other open lists of autocompleted values)                    
                        that._hideAllLists();
                    });
                      
                    // add items to list
                    $(list).append(listItem);

                    // remove styling when data not exist
                    $(input).removeAttr('style')

                    // update _items
                    this._items.push($(listItem[0]).children()[1])
  
                    this._hasData = true;
                }
                else{
                    // add styling when data not exist
                    $(input).css('border-color','red')
                    this.has_data = false;
                }
            }
        });
    }
  
    /*
    *   input keydown event
    */
    _onkeydown(){
        $(this._input).keydown(e=>{
            let x = $('#' + e.target.id + '-autocomplete-list');
            if(x) x = $(x).find('div');
            switch(e.keyCode){
                // down
                case 40:
                    // show existing list
                    this._showAllLists();
                    // If the arrow DOWN key is pressed,
                    // increase the currentFocus variable
                    this._currentFocus++;
                    // and and make the current item more visible
                    this._addActive(x);
                    break;
                // up
                case 38:
                    // show existing list
                    this._showAllLists();
                    // If the arrow UP key is pressed,
                    // decrease the currentFocus variable
                    this._currentFocus--;
                    // and and make the current item more visible
                    this._addActive(x);
                    break;
                // enter
                case 13: 
                    //If the ENTER key is pressed, prevent the form from being submitted
                    e.preventDefault();
                    if (this._currentFocus > -1) {
                        // and simulate a click on the "active" item
                        if (x) x[this._currentFocus].click();
                    }
                    break;
            }
        });
    }
  
    _onclick(){
        $(this._input).click(e=>{
            this._showAllLists();
        });
    }
  
    _closeAllLists(){
        // close all autocomplete lists in the document 
        let x = $('.autocomplete-items');
        for (let i = 0; i < x.length; i++){
            x[i].parentNode.removeChild(x[i]);
        }
    }
  
    _hideAllLists(){
        $('.autocomplete-items').hide();
    }
  
    _showAllLists(){
        $('.autocomplete-items').show();
    }
  
    _addActive(x) {
        // a function to classify an item as "active"
        if (!x) return false;
        // start by removing the "active" class on all items
        this._removeActive(x);
        if (this._currentFocus >= x.length) this._currentFocus = 0;
        if (this._currentFocus < 0) this._currentFocus = (x.length - 1);
        // add class "autocomplete-active"
        $(x[this._currentFocus]).addClass("autocomplete-active");
    }
  
    _removeActive(x) {
        // a function to remove the "active" class from all autocomplete items
        for (var i = 0; i < x.length; i++) {
            $(x[i]).removeClass("autocomplete-active");
        }
    }
  
    /*
    *   jQuery Request
    */
    post(link, params=''){
        if(typeof link != 'string') throw 'error: first arg should be string';
        if(typeof params != 'object' && params!='')  throw 'error: second arg should be object';
        this._promise = $.post(link);
        return this._promise;
    }
  
    /*
    *   jQuery Promise
    */
    then(__promise){
        this._promise.then(res=>__promise(res));
    }
 
    /*
    *   sets list for this._data
    */ 
    setData(list){
        this._data = list;
    }
  
    /*
    *   a callback when item is selected
    */
    itemSelected(__callback){
        $(this._input).on('input', x=>{
            // filter items
            if(typeof this._items === 'undefined' || this._items === 0) return false;
 
            for(let i = 0; i <= this._items.length; i++){
                $(this._items[i]).parent().click(()=>{
                    let $id = $(this._items[i]).data('id');
                    let $value = $(this._items[i]).val();
                    let $input = this._items[i];
                    __callback($id, $value, $input);
                });
            }
        });
    }
}