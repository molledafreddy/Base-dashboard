<template>
    <div :class="loading ? 'box-loading' : ''">
        <div class="slim-mainpanel">
            <div class="container">
                <breadcrumb-slim :position="position"></breadcrumb-slim>
                <div class="section-wrapper">
                    <b-nav tabs>
                      <b-nav-item :active="currentTab == tab.id" v-for="(tab, tabIndex) in tabs" :key="tabIndex" @click="changeTab(tab.id)">
                        {{tab.name}}
                      </b-nav-item>
                    </b-nav>
                    <spinner v-if="loading" :size="200" :color="color.code"/>
                    <form-wizard
                        :title="tabName(currentTab)"
                        :subtitle="trans('app.setting.title')"
                        :color="color.code"
                        shape="tab"
                        ref="wizard"
                        @on-change="changePanel"
                        @on-complete="complete"
                        :back-button-text="changed ? 'Save and Back' : 'Back'"
                        :next-button-text="changed ? 'Save and Next' : 'Next'"
                        :finish-button-text="changed ? 'Save and Finish' : 'Finish'"
                        >
                        <tab-content :icon="panel.icon" v-for="(panel, index) in panels" :key="index" :title="panel.name">
                                <div class="container">
                                    <template v-if="!panel.component">
                                        <button type="button" class="btn pull-right tx-white" :class="'bg-'+color.tx + ' bd-'+color.bd" @click="create(panel.id)">
                                          <i class="fa fa-plus"> </i>
                                        </button>
                                        <div class="clearfix"></div>
                                        <div class="row">
                                            <div :class="setting.type == 'html' ? 'col-md-8' : 'col-md-4'" v-for="(setting, settingIndex) in panel.settings" :key="settingIndex">
                                                <template v-if="setting.key !='color'">
                                                    <label>{{setting.param}}
                                                        <i class="fa fa-pencil btn-mini" :class="'tx-'+color.tx" @click="editParam(setting.id)"></i>
                                                    </label>
                                                </template>
                                                <template v-if="setting.type == 'image'">
                                                    <b-img thumbnail fluid width="320" height="50" :src="setting.value ? setting.value :trans('settings.default_image')" alt="Thumbnail"/>
                                                </template>
                                               <!--  <template v-else-if="setting.key !='color'">
                                                    <ul>
                                                        <li>colores</li>
                                                    </ul>
                                                </template> -->
                                                <template v-else>
                                                    <input-type :setting="setting" @change="changed = true"></input-type>
                                                </template>
                                                
                                            </div>
                                        </div>
                                    </template>
                                    <template v-else>
                                        <div class="row">
                                            <div :is="panel.component"></div>
                                        </div>
                                    </template>
                                </div>
                        </tab-content>
                    </form-wizard>
                    <setting-edit :show="showModal" :draft="draft" @close="close"/>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return{
                position:trans('app.setting.title'),
                editing: null,
                editLabel: false,
                draft: {},
                changed: false,
                showModal: false,
                valor:'#df0b35',
                tabs: [
                    {
                        id: 1,
                        name: trans('app.setting_group.tab1'),
                        icon: 'ti-world',
                    },
                    {
                        id: 2,
                        name: trans('app.setting_group.tab2'),
                        icon: 'ti-shopping-cart',
                    },
                ],
                currentTab: 1,
                activeIndex: 0,
            }
        },
        created(){
            this.getSettings()
        },
        methods:{
            getSettings(){
                let params = {tab: this.currentTab}
                this.$store.dispatch('getSettings', params)
            },
            edit(id){
                this.editing = id
                this.draft = clone(this.getSetting(id))
                this.showModal = true

            },
            cancel(){
                this.editing = null
                this.editLabel = false
                this.draft = {}
            },
            save(){
                alert("ingreso al metodo save")
                console.log("ingreso al metodo save")
                // var draft = this.draft
                // this.$store.dispatch('updateSetting', { id: this.editing, draft })
                // let currentSetting = this.getSetting(this.editing)
                // currentSetting.param = this.draft.param
                // this.editing = null
                // this.editLabel = false
            },
            getSetting(id){
                for (var i = 0; i < this.panels.length; i++) {
                    for (var j = 0; j < this.panels[i].settings.length; j++) {
                        if (this.panels[i].settings[j].id == id) {
                            return this.panels[i].settings[j]
                        }
                    }
                }
                return
            },
            activateAll(){
                this.$refs.wizard.activateAll()
            },
            editParam(id){
                this.editLabel = true
                this.edit(id)
            },
            create(group_id){
                this.draft = {
                    setting_group_id: group_id,
                    param: '',
                    value: '',
                }
                this.showModal = true
            },
            close(){
                this.getSettings()
                this.showModal = false
            },
            complete(){
                this.saveAll()
                this.$refs.wizard.reset()
            },
            changeTab(id){
                this.currentTab = id
                this.getSettings()
                this.$refs.wizard.reset()
                this.activateAll()
            },
            tabName(id){
                for (var i = 0; i < this.tabs.length; i++) {
                    if (this.tabs[i].id == id) {
                        return this.tabs[i].name
                    }
                }
            },
            getColor(){
                this.$store.dispatch('getColor')
            },
            saveAll(){
                if (this.changed ) {
                    var payload = this.panels[this.activeIndex]
                    console.log(payload.settings[0].value)
                    this.$store.dispatch('updatePanel', { id: payload.id, payload })
                    this.changed = false
                    if (payload.settings[0].key == 'color') {
                        // this.$store.dispatch('setSession',payload.settings[0].value)
                        this.getColor()
                    }
                }
            },
            changePanel(prevIndex, nextIndex){
              this.saveAll()
              this.activeIndex = nextIndex;
              this.activateAll()
            },
        },
        computed: {
            panels(){
                return this.$store.state.Setting.settings
            },
            loading(){
                return this.$store.state.Setting.loading
            },
            color(){
              return this.$store.getters.getColor
            },
        }
    }
</script>
<style>
.btn-mini {
    color: #17a2b8;
    text-shadow: 1px 1px 1px #ccc;
    font-size: 1em;
    cursor: pointer;
}
</style>