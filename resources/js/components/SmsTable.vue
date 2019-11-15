<template>
    <div >
        <div v-if="showList == true">
            <div class="btn-group m-b-10 m-r-10" role="group" aria-label="Button group with nested dropdown">
                <button type="button" title="" class="btn btn-secondary font-18 text-dark" ><i class="mdi mdi-inbox-arrow-down"></i></button>
                <button type="button" title="delete selected Items" class="btn btn-secondary font-18 text-dark" v-on:click="deleteItems()"><i class="mdi mdi-delete" ></i></button>
            </div>
            <button type="button " title="refresh list" class="btn btn-secondary m-r-10 m-b-10 text-dark" v-on:click="refreshItems()"><i class="mdi mdi-reload font-18"></i></button>

            <input v-on:keyup="refreshItems()" id="mobile" placeholder="0912..."   v-model="mobile" >

            <div class="btn-group m-b-10 m-r-10 " role="group" aria-label="Button group with nested dropdown">
                <span style=" margin-right: 5px">{{fromNumber}}-{{ toNumber}} of {{ allCount }}</span>
                <button :aria-disabled="checkPrevDisable" type="button" title="previous page" class="btn btn-secondary font-18 text-dark" v-on:click="prevpage()" ><i class="mdi mdi-arrow-left"></i></button>
                <button :aria-disabled="checkNextDisable" type="button" title="next page" class="btn btn-secondary font-18 text-dark" v-on:click="nextpage()"  ><i class="mdi mdi-arrow-right" ></i></button>
            </div>

            <div class="card-block p-t-0">
                <div class="card b-all shadow-none">
                    <div class="inbox-center table-responsive">
                        <table class="table table-hover no-wrap">
                            <thead>
                            <tr>
                                <td>Select</td>
                                <td>Star</td>
                                <td>Mobile</td>
                                <td>Body</td>
                                <td>Created Date</td>
                                <td>API</td>
                                <td>send Date</td>
                                <td>State</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-bind:key="sms.id" v-for="sms in smsList">
                                <td style="width:40px">
                                    <div class="checkbox">
                                        <input :id="'a'+sms.id" type="checkbox" v-on:click="selectSms(sms.id, $event)" value="check">
                                        <label :for="'a'+sms.id" ></label>
                                    </div>
                                </td>
                                <td class="hidden-xs-down" style="width:40px"><i class="fa fa-star-o"></i></td>
                                <td class="hidden-xs-down">  <a v-on:click="showdetail(sms.id)" href="#">{{ sms.mobile}}</a></td>
                                <td class="hidden-xs-down">   <a v-on:click="showdetail(sms.id)" href="#">{{ sms.body }}</a></td>
                                <td class="hidden-xs-down">   <a v-on:click="showdetail(sms.id)" href="#">{{ sms.createdDate }}</a></td>
                                <td class="hidden-xs-down">   <a v-on:click="showdetail(sms.id)" href="#">{{ sms.api }}</a></td>
                                <td class="text-right">   <a v-on:click="showdetail(sms.id)" href="#"> {{ sms.sendDate}}</a></td>
                                <td class="hidden-xs-down">
                                    <a v-on:click="showdetail(sms.id)" href="#">
                                        <span v-bind:class="'label '+sms.state.ColorClass">{{ sms.state.Title }}</span>
                                    </a>
                                </td>



                            </tr>
                            </tbody>


                        </table>
                    </div>
                </div>
            </div>
        </div>
       <div v-if="showList == false">
           <detail-sms v-bind:params="{selectedId }" ></detail-sms>
       </div>
    </div>

</template>

<script>
    export default {

        data() {
            return {
                smsList: [],
                state : -1,
                deleted : 0,
                page : 1,
                mobile: '',
                count : 10,
                allCount : 0,
                fromNumber : 0,
                toNumber : 0,
                nextBtnDisable : false,
                prevBtnDisable : false,
                showList : true,
                selectedId : -1,
                'sms': {
                    'mobile': '',
                    'body': '',
                    'created_at': '',
                    'sent_at': '',
                    'api':'',
                    'state' : ''
                },
                'id': '',
                'pagination': [],
                'edit': false,
                'selectedList':[]
            }
        },
        created() {
            this.fetchSms();
        }
        ,
        methods: {

            fetchSms() {
                axios.get(window.Laravel.baseUrl+"/api/sms/",
                    {
                        params:{
                            state:    this.state == -1   ? null : this.state,
                          //  deleted:  this.deleted == -1 ? null : this.deleted,
                            count: this.count,
                            page: this.page,
                            mobile: this.mobile
                        },
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    }).then(({ data })=> {
                    let res = data;

                    //checking if the next and previous buttons must be enabled or disabled
                    this.nextBtnDisable = false;
                    this.prevBtnDisable = false;

                    this.smsList = res.data.list;
                    this.page = parseInt(res.data.page);
                    this.count = parseInt(res.data.count);
                    this.allCount = parseInt(res.data.all);


                    if (this.allCount > 0){
                        this.fromNumber = (this.page -1) * this.count + 1;
                    }
                    else{
                        this.fromNumber = 0;
                    }
                    if (this.allCount >= 10){
                        this.toNumber =  parseInt(this.fromNumber + this.count -1);
                    }
                    else{
                        this.toNumber =  this.allCount
                    }

                    if ( this.toNumber > this.allCount) {
                        this.toNumber = this.allCount;
                        this.nextBtnDisable = true;
                    }
                    if (this.page == 1){
                        this.prevBtnDisable = true;
                    }
                })
                    .catch((err)=> {
                        console.log("error:", err);
                    });
            },
            refreshItems(){
                this.fetchSms();
            },
            deleteItems(){

                let bodyJson =  JSON.stringify({'idList' : this.selectedList});
                fetch("api/sms", {
                    method: 'Delete',
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json"
                    },
                    body: bodyJson,
                }).then(res => res.json())
                    .then(res => {
                       // console.log(res);
                        this.selectedList = [];
                        this.fetchSms();
                    });
            },

            selectSms(id, event){
               if (event.target.checked){
                   this.selectedList.push(id);
               }
               else{
                   for( var i = 0; i < this.selectedList.length; i++){
                       if ( this.selectedList[i] === id) {
                           this.selectedList.splice(i, 1);
                       }
                   }
               }

            },
            changeState(state){
                this.state = state;
                this.deleted = 0;
                this.setDefaultVariable();
                this.fetchSms();

            },
            getDeletedSms(){
                this.deleted = 1;
                this.state = -1;
                this.setDefaultVariable();
                this.fetchSms();
            },
            allSms(){
                this.state = -1;
                this.deleted = 0;
                this.setDefaultVariable();
                this.fetchSms();
            },
            showdetail(id){
                this.selectedId = id;
                this.showList = false;
            },
            prevpage(){
                if (this.page == 1) {
                    return;
                }
                this.page -= 1;
                this.fetchSms();
            },
            nextpage(){
                if (this.toNumber >= this.allCount) {
                    return;
                }
                this.page += 1;
                this.fetchSms();
            },
            checkPrevDisable(){
                return this.prevBtnDisable;
            },
            checkNextDisable(){
                return this.nextBtnDisable;
            },
            setDefaultVariable(){
                this.fromNumber = 1;
                this.page = 1;
                this.count = 10;
                this.allCount  = 0;
                this.fromNumber = 0;
                this.toNumber = 0;
                this.nextBtnDisable = false;
                this.prevBtnDisable = false;
            }
        }
    }

</script>

