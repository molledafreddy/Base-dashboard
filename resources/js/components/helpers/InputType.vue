<template>
    <div v-if="setting">
        <template v-if="setting.type == 'text' || setting.type == 'number' || setting.type == 'password'">
            <input :type="setting.type" v-model="setting.value" class="form-control" @change="change">
        </template>
        <template v-if="setting.type == 'longText'">
            <textarea v-model="setting.value" class="form-control" @change="change"></textarea>
        </template>
        <template v-if="setting.type == 'boolean'">
            <select v-model="setting.value" class="form-control" @change="change">
                <option :value="null">Select an option</option>
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
        </template>
        <template v-if="setting.type == 'html'">
            <wysiwyg v-model="setting.value" @change="change"/>
        </template>
        <template v-if="setting.type == 'list'">
            <template v-if="setting.key == 'color'">
                <select v-model="setting.value" class="form-control" @change="change">
                    <option :value="null"></option>
                    <template v-for="option in listOptions(setting.options)">
                        <template v-if="option == 'danger'">
                            <option  style="color: #dc3545;" :value="option"> 
                                {{option}}
                            </option>    
                        </template>
                        <template v-else-if="option == 'blue'">
                            <option  style="color: #1b84e7;" :value="option"> 
                                {{option}}
                            </option> 
                        </template>
                        <template v-else-if="option == 'success'">
                            <option  style="color: #23BF08;" :value="option"> 
                                {{option}}
                            </option> 
                        </template>
                        <template v-else-if="option == 'black'">
                            <option  style="color:rgba(0, 0, 0, 0.9);" :value="option"> 
                                {{option}}
                            </option> 
                        </template>
                        <template v-else-if="option == 'warning'">
                            <option  style="color:#F49917" :value="option"> 
                                {{option}}
                            </option> 
                        </template>
                        <template v-else-if="option == 'purple'">
                            <option  style="color: #6f42c1;" :value="option"> 
                                {{option}}
                            </option> 
                        </template>
                        <template v-else-if="option == 'pink'">
                            <option  style="color:#e83e8c;" :value="option"> 
                                {{option}}
                            </option> 
                        </template>
                        <template v-else>
                            <option  style="color: #000046;" :value="option"> 
                                {{option}}
                            </option>
                        </template>
                    </template>
                </select> 
            </template>
            <template v-else>
                <select v-model="setting.value" class="form-control" @change="change">
                    <option :value="null"></option>
                    <option v-for="option in listOptions(setting.options)" :value="option">{{option}}</option>
                </select>        
            </template>
        </template>
        <template v-if="setting.type == 'image'">
            <upload-images v-model="setting.value" :limit="1"></upload-images>
        </template>
    </div>
</template>
<script>
    export default {
        props: ['setting'],

        methods:{
            listOptions(options){
                let result = options.split(', ')
                return result
            },
            change(){
                this.$emit('change')
            }
        },
        computed: {
            color(){
              return this.$store.getters.getColor
            },
        }
    }
</script>