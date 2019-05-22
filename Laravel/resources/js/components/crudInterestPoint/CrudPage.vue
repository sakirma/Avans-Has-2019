<template>
    <div  style="height: 100vh">
        <view-interest-points id="view-interest-points" :onAddOpened="OpenAddPage" :onEditPageOpened="OpenEditPage"></view-interest-points>
        <add-interest-point id="add-interest-point"  v-if="selectedAddPage === true" ></add-interest-point>
        <edit-interest-point id="edit-interest-point" v-if="selectedEditPage.isSelected === true" :_id="Edit().toString()"></edit-interest-point>
    </div>
</template>

<script>
    import AddInterestPoint from './AddInterestPoint';
    import CrudProject from './CrudPage';
    import EditInterestPoint from './EditInterestPoint';
    import ViewInterestPoints from './ViewInterestPoints';



    export default {
        name: 'CrudPage',
        components: {
            AddInterestPoint,
            CrudProject,
            EditInterestPoint,
            ViewInterestPoints,
        },
        data() {
            return {
                selectedEditPage: {
                    isSelected: false,
                    pointId: undefined
                },
                selectedAddPage: false,
            }
        },
        methods: {
            OpenEditPage(pointId) {
                this.selectedEditPage = {
                    isSelected: true,
                    pointId: pointId
                };
                this.selectedAddPage = false;

            },

            Edit(){
                return this.selectedEditPage.pointId.toString();
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
