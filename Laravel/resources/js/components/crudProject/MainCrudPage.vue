<template>
    <div v-resize="UpdateScreen">
        <view-projects id="view-projects" :onAddOpened="OpenEditPage" :onEditPageOpened="OpenAddPage"></view-projects>
        <add-project id="addProject" ></add-project>
        <!-- TODO: DEBUGGING Replace false with true.  -->
        <edit-projects id="editProjects" v-if="selectedEditPage.isSelected === true"></edit-projects>
    </div>
</template>

<!-- TODO: Scroll back to project page when the window is re-sized. -->
<script>
    import MapPage from './components/MapPage';
    import FirstPage from './components/FirstPage';
    import ProjectPage from './components/ProjectPage/ProjectPage';
    import RoutePage from './components/routePage/RoutePage';

    export default {
        name: "MainPage",
        components: {
            MapPage,
            FirstPage,
            ProjectPage,
            RoutePage,
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

                let pageStates = this.$store.getters.pageStates;
                this.$store.commit('setPageState', pageStates.editProjects);
            },

            OpenAddPage() {
                this.selectedAddPage = true;
                this.selectedEditPage.isSelected = false;

                let pageStates = this.$store.getters.pageStates;
                this.$store.commit('setPageState', pageStates.addProject);
                this.GoToSection('#routePage');
            },



            UpdateScreen() {
                let currentPageState = this.$store.getters.getCurrentPageState;
                let pageStates = this.$store.getters.pageStates;

                switch (currentPageState) {
                    case pageStates.view-projects:
                        this.GoToSection('#view-projects');
                        break;
                    case pageStates.addProject:
                        this.GoToSection('#addProject');
                        break;
                    case pageStates.editProjects:
                        this.GoToSection('#editProjects');
                        break;
                }
            },
            GoToSection(id) {
                this.$vuetify.goTo(id, { duration: 500 } );
            },
            disableInputEvents(element) {
                L.DomEvent.disableClickPropagation(element.$el);
                L.DomEvent.disableScrollPropagation(element.$el);
            }
        },
        mounted() {
            this.UpdateScreen();
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
