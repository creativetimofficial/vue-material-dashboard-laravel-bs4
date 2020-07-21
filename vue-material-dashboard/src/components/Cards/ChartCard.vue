<template>
  <md-card
    :data-count="hoverCount"
    class="md-card-chart"
  >
    <md-card-header
      :class="[
        { [getClass(backgroundColor)]: true },
        { 'md-card-header-text': HeaderText },
        { 'md-card-header-icon': HeaderIcon }
      ]"
    >
      <div v-if="chartInsideHeader" :id="chartId" class="ct-chart"></div>
      <slot name="chartInsideHeader"></slot>
    </md-card-header>

    <md-card-content>
      <div v-if="chartInsideContent" :id="chartId" class="ct-chart"></div>
      <slot name="content"></slot>
    </md-card-content>

    <md-card-actions md-alignment="left" v-if="!noFooter">
      <slot name="footer"></slot>
    </md-card-actions>
  </md-card>
</template>
<script>
export default {
  name: "chart-card",
  props: {
    HeaderText: Boolean,
    HeaderIcon: Boolean,
    noFooter: Boolean,
    chartInsideContent: Boolean,
    chartInsideHeader: Boolean,
    chartType: {
      type: String,
      default: "Line" // Line | Pie | Bar
    },
    chartOptions: {
      type: Object,
      default: () => {
        return {};
      }
    },
    chartResponsiveOptions: {
      type: Array,
      default: () => {
        return [];
      }
    },
    chartData: {
      type: Object,
      default: () => {
        return {
          labels: [],
          series: []
        };
      }
    },
    backgroundColor: {
      type: String,
      default: ""
    }
  },
  data() {
    return {
      hoverCount: 0,
      imgHovered: false,
      fixedHeader: false,
      chartId: "no-id"
    };
  },
  computed: {
    headerDown() {
      return this.hoverCount > 15;
    }
  },
  methods: {
    getClass: function(backgroundColor) {
      return "md-card-header-" + backgroundColor + "";
    },
    /***
     * Initializes the chart by merging the chart options sent via props and the default chart options
     */
    initChart(Chartist) {
      var chartIdQuery = `#${this.chartId}`;
      Chartist[this.chartType](
        chartIdQuery,
        this.chartData,
        this.chartOptions,
        this.chartAnimation
      );
    },
    /***
     * Assigns a random id to the chart
     */
    updateChartId() {
      var currentTime = new Date().getTime().toString();
      var randomInt = this.getRandomInt(0, currentTime);
      this.chartId = `div_${randomInt}`;
    },
    getRandomInt(min, max) {
      return Math.floor(Math.random() * (max - min + 1)) + min;
    }
  },
  mounted() {
    this.updateChartId();
    import("chartist").then(Chartist => {
      let ChartistLib = Chartist.default || Chartist;
      this.$nextTick(() => {
        this.initChart(ChartistLib);
      });
    });
  }
};
</script>
