<template>
   <div class="alerta">
       <b-alert
           :show="dismissCountDown"
           dismissible
           fade
           :variant="variant"
           @dismiss-count-down="countDownChanged"
       >
           {{ message }}
       </b-alert>
   </div>
</template>

<script>
export default {
    props: ['message','variant'],
    data() {
        return {
            dismissSecs: 5,
            dismissCountDown: 5,
            showDismissibleAlert: false
        }
    },
    methods: {
        countDownChanged(dismissCountDown) {
            this.dismissCountDown = dismissCountDown
        },
        showAlert() {
            this.dismissCountDown = this.dismissSecs
        }
    }
}
</script>

<style scoped>
    .alerta{
        padding-top: 30px;
    }
</style>
