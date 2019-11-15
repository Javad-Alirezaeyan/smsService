<template>
    <div class="card-block " >
        <div class="card b-all shadow-none">
            <div class="card-block">
                <h3 class="card-title m-b-0">{{ sms.mobile }}</h3>
            </div>
            <div>
                <hr class="m-t-0">
            </div>
            <div class="card-block">
                <div class="d-flex m-b-40">
                    <div>
                        <a href="javascript:void(0)"><img src= "/theme/assets/images/users/1.jpg" alt="user" width="40" class="img-circle" /></a>
                    </div>
                    <div class="p-l-10">
                        <h4 class="m-b-0"></h4>
                        <span>body:</span>
                        <small class="text-muted">{{ sms.body }}</small>
                        <hr/>
                        <span>created Date:</span>
                        <small class="text-muted">{{ sms.createdDate }}</small>
                        <hr />
                        <span>Api:</span>
                        <small class="text-muted">{{ sms.api }}</small>
                        <hr />
                        <span>sent Date:</span>
                        <small class="text-muted">{{ sms.sendDate }}</small>
                        <hr />

                    </div>
                </div>
            </div>
            <div>
                <hr class="m-t-0">
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "SmsDetail",
        props:['params'],

        data() {
            return {
                'sms': [],
                'mobile': '',
                'body': '',
                'createdDate': '',
                'sendDate': '',

            }
        },
        created() {
            this.fetchSms();
        }
        ,
        methods: {
            fetchSms() {
                let id = this.params.selectedId;
                let baseUrl = window.Laravel.baseUrl;

                axios.get(baseUrl+"/api/sms/"+id,
                {
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }).then(({ data })=> {
                    console.log(data.detail);
                    this.sms = data.detail
                    })
                    .catch((err)=> {
                        console.log("error:", err);
                    })
            },
            setId(){
                this.id = id;
                this.fetchSms();
            }

        }
    }

</script>