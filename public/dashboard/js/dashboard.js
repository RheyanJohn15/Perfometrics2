function changeSem(){
  var section= document.getElementById('sections');
  var strands= document.getElementById('strands');
    var changeSem= document.getElementById('changeSem');
    var classroom= document.getElementById('classroom');
    var deploy = document.getElementById('deploy');
    deploy.style.display="none"
    changeSem.style.display= "";
    strands.style.display="none";
    classroom.style.display= "none";
    section.style.display="none";
  }
  
  function addClassroom(){
    var section= document.getElementById('sections');
    var strands= document.getElementById('strands');
    var classroom= document.getElementById('classroom');
    var changeSem= document.getElementById('changeSem');
    var deploy = document.getElementById('deploy');
    deploy.style.display="none"
    changeSem.style.display= "none";
    classroom.style.display= "";
    strands.style.display="none";
    section.style.display="none";
  }

  function addStrand(){
    var section= document.getElementById('sections');
    var strands= document.getElementById('strands');
    var classroom= document.getElementById('classroom');
    var changeSem= document.getElementById('changeSem');
    var deploy = document.getElementById('deploy');
    deploy.style.display="none"
    changeSem.style.display= "none";
    classroom.style.display= "none";
    strands.style.display="";
    section.style.display="none";
  }

  function addSection(){
    var section= document.getElementById('sections');
    var strands= document.getElementById('strands');
    var classroom= document.getElementById('classroom');
    var changeSem= document.getElementById('changeSem');
    var deploy = document.getElementById('deploy');
    deploy.style.display="none"
    changeSem.style.display= "none";
    classroom.style.display= "none";
    strands.style.display="none";
    section.style.display="";
  }

  function deploy(){
    var section= document.getElementById('sections');
    var strands= document.getElementById('strands');
    var classroom= document.getElementById('classroom');
    var changeSem= document.getElementById('changeSem');
    var deploy = document.getElementById('deploy');
    deploy.style.display=""
    changeSem.style.display= "none";
    classroom.style.display= "none";
    strands.style.display="none";
    section.style.display="none";
  }
  
  
  function roomCheckList(){
    const check= document.getElementById('check');
    const list= document.getElementById('list');
    const add= document.getElementById('add');
    const deleteRoom= document.getElementById('deleteRoom');
    const cancelRoom= document.getElementById('cancelRoom');
    const deleteR= document.getElementById('deleteR');
    const addR= document.getElementById('addR');
    deleteRoom.style.display= "none";
    cancelRoom.style.display="";
    add.style.display="none";
    check.style.display="";
    list.style.display="none";
    deleteR.style.display= "";
    addR.style.display= "none";
    const pass= document.getElementById('pass');
    pass.style.display="";
  }

  function roomCancel(){
    const check= document.getElementById('check');
    const list= document.getElementById('list');
    const deleteRoom= document.getElementById('deleteRoom');
    const cancelRoom= document.getElementById('cancelRoom');
    const add= document.getElementById('add');
    const deleteR= document.getElementById('deleteR');
    const addR= document.getElementById('addR');
    check.style.display="none";
    list.style.display="";
    add.style.display="";
    deleteRoom.style.display= "";
    cancelRoom.style.display="none";

    deleteR.style.display= "none";
    addR.style.display= "";
    const pass= document.getElementById('pass');
    pass.style.display="none";
  }

  function strandCheckList(){
    const check= document.getElementById('checkStrand');
    const list= document.getElementById('strandList');
    const add= document.getElementById('addStrand');
    const shortcut= document.getElementById('addStrandShortcut');
    const deleteRoom= document.getElementById('deleteStrand');
    const cancelRoom= document.getElementById('cancelStrand');
    const deleteR= document.getElementById('deleteS');
    const addR= document.getElementById('addS');
    deleteRoom.style.display= "none";
    cancelRoom.style.display="";
    add.style.display="none";
    shortcut.style.display="none";
    check.style.display="";
    list.style.display="none";
    deleteR.style.display= "";
    addR.style.display= "none";
    const pass= document.getElementById('passStrand');
    pass.style.display="";
  }

  function strandCancel(){
    const check= document.getElementById('checkStrand');
    const list= document.getElementById('strandList');
    const add= document.getElementById('addStrand');
    const shortcut= document.getElementById('addStrandShortcut');
    const deleteRoom= document.getElementById('deleteStrand');
    const cancelRoom= document.getElementById('cancelStrand');
    const deleteR= document.getElementById('deleteS');
    const addR= document.getElementById('addS');
    check.style.display="none";
    list.style.display="";
    add.style.display="";
    shortcut.style.display="";
    deleteRoom.style.display= "";
    cancelRoom.style.display="none";

    deleteR.style.display= "none";
    addR.style.display= "";
    const pass= document.getElementById('passStrand');
    pass.style.display="none";
  }

  
  function sectionCheckList(){
    const check= document.getElementById('checkSection');
    const list= document.getElementById('sectionList');
    const strand= document.getElementById('sectionStrand');
    const year= document.getElementById('sectionYear');
    const add= document.getElementById('addSection');
    const deleteRoom= document.getElementById('deleteSection');
    const cancelRoom= document.getElementById('cancelSection');
    const deleteR= document.getElementById('deleteSect');
    const addR= document.getElementById('addSect');
    deleteRoom.style.display= "none";
    cancelRoom.style.display="";
    strand.style.display="none";
    add.style.display="none";
    year.style.display="none";
    check.style.display="";
    list.style.display="none";
    deleteR.style.display= "";
    addR.style.display= "none";
    const pass= document.getElementById('passSection');
    pass.style.display="";
  }

  function sectionCancel(){
    const check= document.getElementById('checkSection');
    const list= document.getElementById('sectionList');
    const strand= document.getElementById('sectionStrand');
    const year= document.getElementById('sectionYear');
    const add= document.getElementById('addSection');
    const deleteRoom= document.getElementById('deleteSection');
    const cancelRoom= document.getElementById('cancelSection');
    const deleteR= document.getElementById('deleteSect');
    const addR= document.getElementById('addSect');
    check.style.display="none";
    list.style.display="";
    add.style.display="";
    strand.style.display="";
    year.style.display="";
    deleteRoom.style.display= "";
    cancelRoom.style.display="none";

    deleteR.style.display= "none";
    addR.style.display= "";
    const pass= document.getElementById('passSection');
    pass.style.display="none";
  }

  function restrictChangeSemYear(element, url){
  const query  = url+'?year='+element.value;
    axios.get(query)
    .then(function (response) {
      const data = response.data;

      const opt1 = document.getElementById('2023-2024');
      const opt2 = document.getElementById('2024-2025');
      const opt3 = document.getElementById('2025-2026');
      const opt4 = document.getElementById('2026-2027');
      const opt5 = document.getElementById('2027-2028');

      const sem1st = document.getElementById('1stSem');
      const sem2nd = document.getElementById('2ndSem');
      const evaluations = data.year;

      if(data.sem === 1 ){
        sem1st.disabled = true;
        sem2nd.disabled = false;
      }else if(data.sem===2){
        sem1st.disabled = true;
        sem2nd.disabled = true;
      }else{
        sem1st.disabled = false;
        sem2nd.disabled = false;
      }
     console.log(evaluations);
      // Loop through each element in the array
      evaluations.forEach(function (evaluation) {
        switch (evaluation[0]) {
          case '2023-2024':
            opt1.disabled = true;
            if (evaluation[1] === 2) {
              sem1st.disabled = true;
              sem2nd.disabled = true;
            }  else if (evaluation[1] === 0) {
              opt1.disabled = false;
              sem1st.disabled = false;
              sem2nd.disabled = false;
            }else{
              opt1.disabled = false;
            }
            
            break;
          case '2024-2025':
            opt2.disabled = true;
            if (evaluation[1] === 2) {
              sem1st.disabled = true;
              sem2nd.disabled = true;
            } else if (evaluation[1] === 0) {
              opt2.disabled = false;
              sem1st.disabled = false;
              sem2nd.disabled = false;
            }else{
              opt2.disabled = false;
            }
            break;
          case '2025-2026':
            opt3.disabled = true;
            if (evaluation[1] === 2) {
              sem1st.disabled = true;
              sem2nd.disabled = true;
            }  else if (evaluation[1] === 0) {
              opt3.disabled = false;
              sem1st.disabled = false;
              sem2nd.disabled = false;
            }else{
              opt3.disabled = false;
            }
            break;
          case '2026-2027':
            opt4.disabled = true;
            if (evaluation[1] === 2) {
              sem1st.disabled = true;
              sem2nd.disabled = true;
            }  else if (evaluation[1] === 0) {
              opt4.disabled = false;
              sem1st.disabled = false;
              sem2nd.disabled = false;
            }else{
              opt4.disabled = false;
            }
            break;
          case '2027-2028':
            opt5.disabled = true;
            if (evaluation[1] === 2) {
              sem1st.disabled = true;
              sem2nd.disabled = true;
            }else if (evaluation[1] === 0) {
              opt5.disabled = false;
              sem1st.disabled = false;
              sem2nd.disabled = false;
            }else{
              opt5.disabled = false;
            }
            break;
          // Add more cases for other years if needed
        }
      });
    })
    .catch(function (error) {
      // Handle error
      console.error('Error:', error);
    });
  }