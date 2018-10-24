/**
 * @brief Render an iframe and insert it
 * @author Created by voidnoble
 * @date 2018-09-19
 * @description
 */
var adverIns = document.getElementsByClassName("adver-voidnoble");

var id = "", adverId = "", ifr = "", ins, adver;

for (var i = 0; i < adverIns.length; i++) {
    adver = adverIns[i];
    id = adver.getAttribute('id');
    adverId = id.replace("adver-voidnoble-", "");

    ifr = '<iframe id="ifr-'+ id +'" src="'+ location.protocol +'//'+ location.host +'/render/'+ adverId +'" frameborder="0"></iframe>';
    ins = document.getElementById(id);
    ins.innerHTML = ifr;
}
