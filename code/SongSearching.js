function reloadResults(e) {
        search(e.target.value);
}

function limitedSearch() {
        var colLim = document.getElementById("colSearch");
        limit = colLim[colLim.selectedIndex].value;
        search(limit);
}

function keywordSearch(tr, filter, limit) {
        if (filter === "") {
                for (var i = 0; i < tr.length; i++) {
                        tr[i].style.display = "";
                }
                
                return;
        }
        
        for (var i = 0; i < tr.length; i++) {
                var td = tr[i].getElementsByClassName("dataCells");
                if (td) {
                        if (limit === "-1") {
                                for (var j = 0; j < td.length; j++) {
                                        if (td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
                                                tr[i].style.display = "";
                                                j = td.length;
                                        } else {
                                                tr[i].style.display = "none";
                                        }
                                }
                        } else {
                                if (td[limit].innerHTML.toUpperCase().indexOf(filter) > -1) {
                                        tr[i].style.display = "";
                                        j = td.length;
                                } else {
                                        tr[i].style.display = "none";
                                }
                        }
                }
        }
}

function keywordSearchById(index) {
        if (index == "" || index == -1) {
                return;
        }

        var tr = document.getElementById(index);
        var td = tr.getElementsByClassName("dataCells");
        return td[0].innerHTML + " - " + td[1].innerHTML + "\nLink: " + td[2].children[0].href;
}

function search(limit) {
        var input, filter, table, tr;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("Songs");
        tr = table.getElementsByClassName("dataRows");

        keywordSearch(tr, filter, limit);
}

function copySongData(event, index) {
        var b = document.getElementById("b"+index);
        var textArea = document.createElement("textarea");
        textArea.value = keywordSearchById(index);
        textArea.id = "temp";
        textArea.style.position = 'fixed';
        textArea.style.top = 0;
        textArea.style.left = 0;
        textArea.style.width = '1px';
        textArea.style.height = '1px';
        b.appendChild(textArea);
        textArea.select();
        try {
                var successful = document.execCommand('copy');
                var msg = successful ? 'successful' : 'unsuccessful';
                console.log('Copying text command was ' + msg);
        } catch (err) {
                console.log('Oops, unable to copy');
        }

        b.removeChild(textArea);
}