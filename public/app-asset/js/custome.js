function autocomplete(inp, arr,identity) {
    var currentFocus;
    
    inp.addEventListener("input", function(e) {
  
        resetproperty();
        var a, b, i, val = this.value;
        closeAllLists();
        if (!val) { return false;}
        currentFocus = -1;
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        this.parentNode.appendChild(a);
  
  
        for (i = 0; i < arr.length; i++) {
          
          if (arr[i].nik.substr(0, val.length).toUpperCase() == val.toUpperCase() || arr[i].nama.substr(0, val.length).toUpperCase() == val.toUpperCase()) {
  
            b = document.createElement("DIV");
            
            if(arr[i].nik.substr(0, val.length).toUpperCase() == val.toUpperCase())
            {                
              b.innerHTML = "<strong>" + arr[i].nik.substr(0, val.length) + "</strong>";
              b.innerHTML += arr[i].nik.substr(val.length)+ " / " + arr[i].nama;
            }
            else if(arr[i].nama.substr(0, val.length).toUpperCase() == val.toUpperCase())
            {    
              b.innerHTML = arr[i].nik +" / ";
              b.innerHTML += "<strong>" + arr[i].nama.substr(0, val.length) + "</strong>" + arr[i].nama.substr(val.length);
            }
  
            b.innerHTML += "<input type='hidden' value='" + arr[i].penduduk_id + "'>";
  
            b.addEventListener("click", function(e) {
               var penduduk_id = this.getElementsByTagName("input")[0].value;
               var _penduduk =  penduduk.filter(x => x.penduduk_id == penduduk_id);
               if(_penduduk.length)
               {
                  temp = {
                      penduduk_id:_penduduk[0].penduduk_id,
                      nik:_penduduk[0].nik,
                      nama:_penduduk[0].nama
                      };
                
                inp.value = temp.nik + " / " + temp.nama;
                $("#"+identity+"").val(_penduduk[0].penduduk_id);
               }
  
                closeAllLists();
            });
            a.appendChild(b);
          }
        }
  
    });
    inp.addEventListener("blur", function (e) {
          if(temp.penduduk_id == null)
          {
             inp.value = null;
             $("#"+identity+"").val(null);
          }else
          {
              inp.value = temp.nik + " / " + temp.nama;
          }
    });
    inp.addEventListener("focus", function (e) {
         if(temp.penduduk_id !== null && temp.penduduk_id !== undefined && temp.penduduk_id !== ""){
              inp.value = temp.nik;
         }
    });
    inp.addEventListener("keydown", function(e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
          currentFocus++;
          addActive(x);
        } else if (e.keyCode == 38) {
          currentFocus--;
          addActive(x);
        } else if (e.keyCode == 13) {
          e.preventDefault();
          if (currentFocus > -1) {
            if (x) x[currentFocus].click();
          }
        }
    });
    function addActive(x) {
      /*a function to classify an item as "active":*/
      if (!x) return false;
      /*start by removing the "active" class on all items:*/
      removeActive(x);
      if (currentFocus >= x.length) currentFocus = 0;
      if (currentFocus < 0) currentFocus = (x.length - 1);
      /*add class "autocomplete-active":*/
      x[currentFocus].classList.add("autocomplete-active");
    }
    function removeActive(x) {
      /*a function to remove the "active" class from all autocomplete items:*/
      for (var i = 0; i < x.length; i++) {
        x[i].classList.remove("autocomplete-active");
      }
    }
    function closeAllLists(elmnt) {
  
      var x = document.getElementsByClassName("autocomplete-items");
      for (var i = 0; i < x.length; i++) {
        if (elmnt != x[i] && elmnt != inp) {
          x[i].parentNode.removeChild(x[i]);
        }
      }
    }
  
    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
  
    function resetproperty()
    {
      temp = {
        penduduk_id:null,
        nik:null,
        nama:null
      };
      $("#"+identity+"").val(null);
    }

    var penduduk_id = $("#"+identity+"").val();

    if(penduduk_id !== null && penduduk_id!== undefined && penduduk_id !== "")
    {
        var _penduduk =  penduduk.filter(x => x.penduduk_id == penduduk_id);
                if(_penduduk.length)
                {
                    temp = {
                        penduduk_id:_penduduk[0].penduduk_id,
                        nik:_penduduk[0].nik,
                        nama:_penduduk[0].nama
                        };
                    
                        inp.value = temp.nik + " / " + temp.nama;
                }
    }
  }