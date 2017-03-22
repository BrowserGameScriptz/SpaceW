function httpGet(theUrl)
{
    if (window.XMLHttpRequest)
    {
        xmlhttp=new XMLHttpRequest();
    }
    else
    {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
			alert(xmlhttp.responseText);
			location.reload();
        }
    };;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
    xmlhttp.open("GET", theUrl, false );
    xmlhttp.send();    
}

function upgrade(planetid,item,user){
    httpGet("http://cripplingdepression.site11.com/upgrade.php?planetid=" + planetid + "&upgrade" + item + "=1&user=" + user);
}


function upgradeSteel(planetid,user){
	upgrade(planetid,"Steel",user);
}

function upgradeAluminium(planetid,user){
    upgrade(planetid,"Aluminium",user);
}

function upgradeUranium(planetid,user){
    upgrade(planetid,"Uranium",user);
}

function upgradeShipyard(planetid,user){
    upgrade(planetid,"SolarPanel");
}

function upgradeOrbitalDefense(planetid,user){
    upgrade(planetid,"OrbitalDefense");
}

function upgradeFarm(planetid,user){
    upgrade(planetid,"Farm");
}