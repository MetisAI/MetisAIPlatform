function t()
{
    return '';
    if (Math.random()>0.5) return ''
    if (Math.random()>0.5) return '<img src="11.png" style="text-align: center; width: 54px;height:50px;"></img>';
    else return '<img src="22.png" style=" text-align=center;width:54px;height:54px;"></img>';
}
$("document").ready(function()
{
    var s="";
    for (var i=0;i<8;i++)
    {
        s+="<tr>";
        for (var j=0;j<8;j++)
            s+="<td>"+t()+"</td>";
        s+="</tr>";
    }
    $("#tb").append(s);
}
);