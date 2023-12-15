function save(sem){
    const save= document.getElementById('saveEvalData');
    const data= document.getElementById('saveData')
   const reset = document.getElementById('resetData');
   const deleteData = document.getElementById('deleteData');
    const monthNames = [
        "January", "February", "March",
        "April", "May", "June", "July",
        "August", "September", "October",
        "November", "December"
      ];
      
      // Get the current date
      const currentDate = new Date();
      
      // Extract date parts
      const day = currentDate.getDate();
      const month = currentDate.getMonth(); // Note: Month is 0-indexed
      const year = currentDate.getFullYear();
      
      // Convert month to its corresponding word form
      const monthInWords = monthNames[month];
      
      // Create the formatted date string
      const formattedDate = `${day}-${monthInWords}-${year}`;
      
    save.style.display='';
    reset.style.display='none';
    deleteData.style.display="none";
    data.value= formattedDate +"-"+ sem + "-Semester";
}

function ResetData(){
  const save= document.getElementById('saveEvalData');
 const reset = document.getElementById('resetData');
 const deleteData = document.getElementById('deleteData');

 save.style.display= 'none';
 reset.style.display='';
 deleteData.style.display="none";
}
function ScoreEditor(){
  const save = document.getElementById('saveEvalData');
  const deleteData= document.getElementById('deleteData');
  const score = document.getElementById('scorePercentage');
  const reset = document.getElementById('resetData');

  deleteData.style.display = 'none';
  reset.style.display='none';
  save.style.display ='none';
  score.style.display='';
 }
 function limitInputLength(input, maxLength) {
   const student = document.getElementById('studentWeight');
   const coordinator = document.getElementById('coordinatorWeight');
   const button = document.getElementById('weightSubmit');
   const text = document.getElementById('invalidValues');

   const perStudent = parseInt(student.value);
   const perCoordinator = parseInt(coordinator.value);
   if(perStudent + perCoordinator != 100){
    button.disabled= true;
    text.style.display= '';
   }else{
    button.disabled=false;
    text.style.display='none';
   }
if (input.value.length > maxLength) {
input.value = input.value.slice(0, maxLength);
}
}

function deleteData(){
  const save= document.getElementById('saveEvalData');
  const reset = document.getElementById('resetData');
  const deleteData = document.getElementById('deleteData');
 
  save.style.display= 'none';
  reset.style.display='none';
  deleteData.style.display="";
}

function radioData(data){
  const radio = document.getElementById('radioData');

  radio.value= data;
}