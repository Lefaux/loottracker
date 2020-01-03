import Sortable from 'sortablejs';

$(function () {

  let raidGroup = 'new';
  let unsortedPlayers = document.querySelector('.unsorted-players');
  let raidGroups = document.querySelectorAll('.groupbuilder-raidgroup');
  if (unsortedPlayers) {
    /*********************************************** FUNCTIONS ***********************************************/

    let onEnd = function() {
      for (let raidGroup of raidGroups) {
        raidGroup.classList.remove('drag-background');
      }
      unsortedPlayers.classList.remove('drag-background');
      saveData();
    };

    let onStart = function(event) {
      let weekday = event.item.dataset.weekday;
      raidGroups = document.querySelectorAll('.groupbuilder-raidgroup[data-weekday="' + weekday  + '"]');
      for (let raidGroup of raidGroups) {
        raidGroup.classList.add('drag-background');
      }
      unsortedPlayers.classList.add('drag-background');
    };

    let onAddGroup = function(event) {
      let accountId = event.item.dataset.account;
      let characters = document.querySelectorAll('[data-account="' + accountId  + '"]');
      for (let character of characters) {
        if (character !== event.item) {
          // character.classList.add('text-muted');
          character.style.display = 'none';
        }
      }
      updateCounter();
      specCounter('alpha');
      // specCounter('bravo');
    };

    let onAddList = function(event) {
      let accountId = event.item.dataset.account;
      let characters = document.querySelectorAll('[data-account="' + accountId  + '"]');
      for (let character of characters) {
        if (character !== event.item) {
          // character.classList.remove('text-muted');
          character.style.display = 'block';
        }
      }
      updateCounter();
      specCounter('alpha');
      // specCounter('bravo');
    };

    let updateCounter = function() {
      let divs = unsortedPlayers.children;
      let divsArray = [].slice.call(divs);
      let displayShow = divsArray.filter(function(el) {
        return getComputedStyle(el).display !== "none"
      });
      let counterContainer = document.getElementById('unassigned-players');
      counterContainer.innerText = displayShow.length.toString();
    };

    /**
     * Counts Specs and Classes
     * @param team
     */
    let specCounter = function(team) {
      let tanks = document.querySelectorAll('.groupbuilder-raidgroup.'+team+' li[data-spec="1"]');
      let heals = document.querySelectorAll('.groupbuilder-raidgroup.'+team+' li[data-spec="2"]');
      let dps = document.querySelectorAll('.groupbuilder-raidgroup.'+team+' li[data-spec="3"]');
      let counterTanks = document.getElementById('count-tank-'+team);
      counterTanks.innerText = tanks.length.toString();
      let counterHeals = document.getElementById('count-heal-'+team);
      counterHeals.innerText = heals.length.toString();
      let counterDps = document.getElementById('count-dps-'+team);
      counterDps.innerText = dps.length.toString();
      let counterTotal = document.getElementById('count-sum');
      counterTotal.innerText = (dps.length + tanks.length + heals.length).toString();
      // ****************** Loop over classes **************//
      let classes = [1,2,3,4,5,6,7,9];
      for(let i = 0; i < classes.length; i++) {
        let playerClass = document.querySelectorAll('.groupbuilder-raidgroup.'+team+' li[data-class="' + classes[i]  + '"]');
        let counterClass = document.getElementById('count-' + classes[i]  + '-'+team);
        counterClass.innerText = playerClass.length.toString();
      }
    };

    let saveData = function() {
      let loader = document.getElementById('loader');
      let raidElement = document.querySelector('#raid-id');
      let raidNameElement = document.querySelector('#raid-name');
      let raidZoneElement = document.querySelector('#raid-zone');
      let metaForm = document.querySelector('#meta-form');
      let raidId = raidElement.dataset.raidid;
      let raidGroupDataValue = raidElement.dataset.raidgroup;
      if (parseInt(raidGroupDataValue) > 0) {
        raidGroup = raidGroupDataValue;
      }
      let payLoad = {
        'raidEvent': raidId,
        'raidGroup': raidGroup,
        'raidName': raidNameElement.value,
        'raidZone': raidZoneElement.value,
        'status': metaForm.elements['setup-status'].value,
        'groups': []
      };
      let itemCheckPayload = {
        'raidZone': parseInt(raidZoneElement.value),
        'players': []
      };
      let raidGroups = document.querySelectorAll('.groupbuilder-raidgroup');
      for (let raidGroup of raidGroups) {
        payLoad.groups[raidGroup.dataset.group] = Array();
        let nodes = raidGroup.children;
        let counter = 0;
        for (let char of nodes) {
          payLoad.groups[raidGroup.dataset.group][counter] = char.dataset.character;
          itemCheckPayload.players.push(parseInt(char.dataset.character));
          counter++;
        }
      }
      loader.innerHTML = '<i class="fas fa-sync fa-spin"></i> working';
      postAjax('/api/groupbuild/save', payLoad, ajaxSuccess);
      postAjax('/api/groupbuild/bisitems', itemCheckPayload, bisResponse);
    };

    let ajaxSuccess = function(response) {
      let responseCode = JSON.parse(response);
      raidGroup = responseCode.raidGroupId.toString();
    };

    let bisResponse = function(response) {
      let responseCode = JSON.parse(response);
      let needList = document.querySelector('#item-need');
      // Clear als children
      while (needList.firstChild) {
        needList.removeChild(needList.firstChild);
      }
      // create new list
      // let li = document.createElement('li');
      let nodeContent = '';
      for (let entry in responseCode) {
        nodeContent = nodeContent + `
    <tr class="table-active">
        <td colspan="2">
            <smallx>
                <a href="#" data-wowhead="item=${responseCode[entry].item.id}&amp;domain=classic" data-wh-icon-size="small" class="">${responseCode[entry].item.name}</a>
            </smallx>
        </td>
    </tr>`;
        for (let rank in responseCode[entry].need) {
          let players = responseCode[entry].need[rank].join(', ');
          let fullBadge = '';
          let lineColor = '';
          switch(rank) {
            case 'Core':
              fullBadge = '<i class="fa fa-fw fa-copyright" style="color: #B84B9E" title="Core"></i>';
              lineColor = '#4ec04e';
              break;
            case 'Raider':
              fullBadge = '<i class="fa fa-fw fa-registered" style="color: #93228D" title="Raider"></i>';
              lineColor = '#a6c34c';
              break;
            case 'Oldies':
              fullBadge = '<i class="fa fa-fw fa-chess-rook" style="color: #FF6EB0" title="Oldies"></i>';
              lineColor = '#ffc84a';
              break;
            case 'F&F':
              fullBadge = '<i class="fa fa-fw fa-child" style="color: #FFCB00" title="Family & Friends"></i>';
              lineColor = '#f48847';
              break;
            case 'Twink':
              fullBadge = '<i class="fa fa-fw fa-tenge" style="color: #FFCB00" title="Family & Friends"></i>';
              lineColor = '#eb4841';
              break;
            default:
              fullBadge = '<i class="fa fa-fw fa-question-circle" style="color: #ff00ff" title="unclear"></i>';
          }
          nodeContent = nodeContent + `
          <tr style="background-color: ${lineColor}">
            <td>${fullBadge}</td>
            <td><small>${players}</small></td>
          </tr>
          `;
        }

        // li.innerHTML = nodeContent;
        // li.setAttribute("class", "list-group-item"); // added line
      }
      needList.innerHTML = nodeContent;
      let loader = document.getElementById('loader');
      loader.innerHTML = '';
    };

    /*********************************************** AJAX ***********************************************/

    function postAjax(url, data, success) {
      let xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
      xhr.open('POST', url);
      xhr.onreadystatechange = function() {
        if (xhr.readyState>3 && xhr.status === 200) { success(xhr.responseText); }
      };
      xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
      xhr.setRequestHeader('Content-Type', 'application/json');
      xhr.send(JSON.stringify(data));
      return xhr;
    }

    /*********************************************** SORTABLE ************************************************/

    for (let raidGroup of raidGroups) {
      let name = raidGroup.dataset.weekday;
      new Sortable(raidGroup, {
        group: {
          name: name,
          put: function (to) {
            // let playerDay = item.dataset.weekday;
            return to.el.children.length < 5;
          }
        },
        animation: 150,
        onStart: onStart,
        onEnd: onEnd,
        onAdd: onAddGroup
      });
    }
    new Sortable(unsortedPlayers, {
      animation: 150,
      group: {
        put: true
      },
      onStart: onStart,
      onEnd: onEnd,
      onAdd: onAddList
    });
    updateCounter();
    specCounter('alpha');

    /*********************************************** META FORM ************************************************/

    let metaForm = document.querySelector('#meta-form');
    metaForm.addEventListener('change', function() {
      saveData();
    });

    let bisButton = document.querySelector('#load-bis-info');
    bisButton.addEventListener('click', function() {
      saveData();
    })
  }


});