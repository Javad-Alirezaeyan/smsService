<template>

    <div class="card-block">
        <h3 class="card-title">Compose New SMS</h3>
        <div v-if="errors.length">
            <b>Please correct the following error(s):</b>
            <ul>
                <li class="text-danger" v-for="error in errors">{{ error }}</li>
            </ul>
        </div>


        <div class="form-group">

            <input class="form-control" id="mobile"   v-model="mobile"  placeholder="mobile:09120000000">
        </div>

        <div class="form-group">
            <textarea class="textarea_editor form-control" v-model="body"   rows="15" placeholder="Enter text ..."></textarea>
        </div>

        <button type="submit" v-on:click="validation"  class="btn btn-success m-t-20"><i class="fa fa-envelope-o"></i> Send</button>
        <button class="btn btn-inverse m-t-20"><i class="fa fa-times"></i> Discard</button>
    </div>


</template>

<script>

    export default {

        mounted() {

            // /console.log('Component mounted.')
        },

        data() {

            return {
                mobile: '',
                body: '',
                errors: []
            };

        },

        methods: {

            validation(){
                //validate form

                let valid =  true;
                this.errors = [];

                if ( this.mobile ==  "" || this.mobile.length !=11 ){
                    this.errors.push("mobile isn't valid");
                    valid = false;
                }
                if ( this.body.length < 3 ){
                    this.errors.push("body must be larger than 3 character");
                    valid = false;
                }
                if (valid){
                    this.submit();
                }
            },
            submit() {
                //send data to api
                let currentObj = this;
                let senddata = {
                    mobile: this.mobile,
                    body: this.body,
                };
                $.ajax({
                    url: "api/sms/send",
                    type: 'get',
                    data: senddata,
                    dataType: 'json',
                })
                    .done(function (res, textStatus, xhr) {
                        if (xhr.status == 200){
                            window.location.href  = window.Laravel.baseUrl;;
                        }
                        else{
                            this.errors = res.errors;
                        }
                    })
                    .fail(function (jqXHR, textStatus) {
                        console.log(jqXHR.responseText);
                    });
            }

        }

    }

</script>

