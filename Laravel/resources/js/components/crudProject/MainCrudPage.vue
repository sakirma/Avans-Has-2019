<template>
    <div  style="height: 100vh">
        <view-projects id="view-projects" :onAddOpened="OpenAddPage" :onEditPageOpened="OpenEditPage"></view-projects>
        <add-project id="addProject"  v-if="selectedAddPage === true" ></add-project>
        <edit-projects id="editProjects" v-if="selectedEditPage.isSelected === true" :_id="Edit().toString()"></edit-projects>
    </div>
</template>

<script>
    import AddProject from './AddProject';
    import MainCrudProject from './MainCrudPage';
    import EditProjects from './EditProjects';
    import ViewProjects from './ViewProjects';



    export default {
        name: 'MainCrudPage',
        components: {
            AddProject,
            MainCrudProject,
            EditProjects,
            ViewProjects,
        },
        data() {
            return {
                selectedEditPage: {
                    isSelected: false,
                    projectId: undefined
                },
                selectedAddPage: false,
            }
        },
        methods: {
            OpenEditPage(projectId) {
                this.selectedEditPage = {
                    isSelected: true,
                    projectId: projectId
                };
                this.selectedAddPage = false;

            },

            Edit(){
                return this.selectedEditPage.projectId.toString();
            },

            OpenAddPage() {
                this.selectedAddPage = true;
                this.selectedEditPage.isSelected = false;


            },
        },
        mounted() {
        }
    }
</script>

<style>
    .vb > .vb-dragger {
        z-index: 5;
        width: 12px;
        right: 0;
    }

    .vb > .vb-dragger > .vb-dragger-styler {
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        -webkit-transform: rotate3d(0,0,0,0);
        transform: rotate3d(0,0,0,0);
        -webkit-transition:
                background-color 100ms ease-out,
                margin 100ms ease-out,
                height 100ms ease-out;
        transition:
                background-color 100ms ease-out,
                margin 100ms ease-out,
                height 100ms ease-out;
        background-color: rgba(64, 64, 64, 0.64);
        margin: 5px 5px 5px 0;
        border-radius: 10px;
        height: calc(100% - 10px);
        display: block;
    }

    .vb.vb-scrolling-phantom > .vb-dragger > .vb-dragger-styler {
        background-color: rgba(64, 64, 64, 0.64);
    }

    .vb > .vb-dragger:hover > .vb-dragger-styler {
        background-color: rgba(64, 64, 64, 0.64);
        height: 100%;
    }

    .vb.vb-dragging > .vb-dragger > .vb-dragger-styler {
        background-color: rgba(64, 64, 64, 0.64);
        height: 100%;
    }

    .vb.vb-dragging-phantom > .vb-dragger > .vb-dragger-styler {
        background-color: rgba(64, 64, 64, 0.64);
    }
</style>
