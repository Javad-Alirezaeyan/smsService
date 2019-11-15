<template>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="row">
                        <div class="col-xlg-2 col-lg-2 col-md-4">
                            <div class="card-block inbox-panel">
                                <a href="#"  v-on:click="setCompose()" class="btn btn-danger m-b-20 p-10 btn-block waves-effect waves-light">Compose</a>
                                <ul class="list-group list-group-full">
                                    <!-- <li class="list-group-item active"> <a href="javascript:void(0)"><i class="mdi mdi-gmail"></i> Inbox </a><span class="badge badge-success ml-auto">6</span></li>-->
                                    <li class="list-group-item ">
                                        <a href="#"  v-on:click="changeState(-1)">
                                            <i class="mdi mdi-file-document-box" ></i>
                                            Sent Sms
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href=""> <i class="mdi mdi-star"></i> Starred </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href=""> <i class="mdi mdi-send"></i> Draft </a><span class="badge badge-danger ml-auto">0</span></li>

                                    <li class="list-group-item">
                                        <a href="#"  v-on:click="deletedList()"> <i class="mdi mdi-delete"></i> Trash </a>
                                    </li>
                                </ul>
                                <h3 class="card-title m-t-40">Labels</h3>
                                <div class="list-group b-0 mail-list">
                                    <a href="#" class="list-group-item"  v-on:click="changeState(0)"  ><span class="fa fa-circle text-warning m-r-10"></span>Queued</a>
                                    <a href="#" class="list-group-item" v-on:click="changeState(1)"><span class="fa fa-circle text-danger m-r-10"></span>Notsent</a>
                                    <a href="#" class="list-group-item" v-on:click="changeState(2)"><span class="fa fa-circle text-success m-r-10"></span>Sent</a>
                                </div>
                            </div>
                        </div>

                        <div id="frameContent" class="col-xlg-10 col-lg-10 col-md-8"   >
                            <div v-if="content == 0 ">
                                <table-sms  ref="tablesms"></table-sms>
                            </div>
                            <div v-if="content == 1 ">
                                <compose-sms  ></compose-sms>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

</template>


<script>
    export default {
        name: "SmsFrame",

        data() {
            return {
                content : 0,
            }
        },
        created() {
            this.content = 0;
        },
        mounted() {
        }
        ,
        methods: {
            setCompose() {
                this.content = 1;

            },
            changeState(state){
                this.content = 0;
                let child = this.$refs.tablesms;
                child.showList = true;
                child.changeState(state);
            },
            deletedList(){
                this.content = 0;
                /*let child = this.$refs.tablesms;
                child.showList = true;
                child.getDeletedSms();*/
            }

        }
    }

</script>
