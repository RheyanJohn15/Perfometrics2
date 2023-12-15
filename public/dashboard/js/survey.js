function maintenanceQuestion(questions, id){
   const edit= document.getElementById('fab_edit');
   const deleteData= document.getElementById('fab_delete');
   const edit_id= document.getElementById('q_id_edit');
   const delete_id= document.getElementById('q_id_delete');
   const question = document.getElementById('questionEdit');
   const fabAdd= document.getElementById('fab_add');

   edit.style.animation= "surveyPopEdit 0.3s linear";
   deleteData.style.animation="surveyPopDelete 0.3s linear";
   fabAdd.style.animation= "surveyOutDelete 0.3s linear";


   edit_id.value= id;
   delete_id.value= id;

   question.value = questions;
    setTimeout(function(){
    edit.style.display= "flex";
    deleteData.style.display="flex";
    fabAdd.style.display="none";
    },300);
   
}


function editQuestion(){
    const editQuestion= document.getElementById('editQuestion');
    const deleteQuestion = document.getElementById('deleteQuestion');
    const addQuestion = document.getElementById('addQuest');

    editQuestion.style.display="";
    deleteQuestion.style.display="none";
    addQuestion.style.display="none";
}

function deleteQuestion(){
    const editQuestion= document.getElementById('editQuestion');
    const deleteQuestion = document.getElementById('deleteQuestion');
    const addQuestion = document.getElementById('addQuest');

    editQuestion.style.display="none";
    deleteQuestion.style.display="";
    addQuestion.style.display="none";
}
function addQuestion(){
    const editQuestion= document.getElementById('editQuestion');
    const deleteQuestion = document.getElementById('deleteQuestion');
    const addQuestion = document.getElementById('addQuest');

    editQuestion.style.display="none";
    deleteQuestion.style.display="none";
    addQuestion.style.display="";
}
document.addEventListener("click", function (event) {
    // Check if the click event target is not a radio button or its label
    if (!event.target.matches("input[type='radio']") && !event.target.matches("label[for^='radioButton']")) {
      // Unselect all radio buttons with the name "myRadio"
      var radioButtons = document.getElementsByName("selectedData");
      for (var i = 0; i < radioButtons.length; i++) {
        radioButtons[i].checked = false;
      }
      const edit= document.getElementById('fab_edit');
      const deleteData= document.getElementById('fab_delete');
      const fabAdd= document.getElementById('fab_add');
 
      edit.style.animation= "surveyOutEdit 0.3s linear";
      deleteData.style.animation="surveyOutDelete 0.3s linear";
      fabAdd.style.animation= "surveyPopDelete 0.3s linear";
      setTimeout(function(){
        edit.style.display= "none";
        deleteData.style.display="none";
        fabAdd.style.display= "flex";
      },300);
    }
  });

