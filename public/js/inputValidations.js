$(document).on("input", ".number-validation", function () {
    this.value = this.value.replace(/\D/g, '');
});