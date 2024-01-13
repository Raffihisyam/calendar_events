$(document).ready(function() {
$('#form-action').on('submit', function(event) {
console.log('form submit');
event.preventDefault();
const form = this;
const formData = new FormData(form)
$.ajax({
url: form.action,
method: form.method,
data: formData,
processData: false,
contentType: false,
success: function(res) {
console.log(res);
modal.modal('hide');
calendar.refetchEvents();
}
})
})
});
