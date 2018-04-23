<script type="text/javascript" charset="utf-8">
function copySongData(index) {
    var copy = ""
    songData.forEach(function (dataRow) {
            if (index == dataRow[4]) {
                    copy = dataRow[0] + " - " + dataRow[1] + "\nLink" + dataRow[2];
                    document.execCommand("copy", false, copy);
                    return;
            }
    });
}
</script>