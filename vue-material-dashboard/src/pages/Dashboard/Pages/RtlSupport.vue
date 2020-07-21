<template>
  <div class="md-layout">
      <div class="md-layout-item md-medium-size-50 md-xsmall-size-100 md-size-25">
        <stats-card header-color="blue">
          <template slot="header">
            <div class="card-icon">
              <i class="fab fa-twitter"></i>
            </div>
            <p class="category">متابعون</p>
            <h3 class="title">
              +245
            </h3>
          </template>

          <template slot="footer">
            <div class="stats">
              <md-icon>update</md-icon>
              تم التحديث للتو
            </div>
          </template>
        </stats-card>
      </div>
      <div class="md-layout-item md-medium-size-50 md-xsmall-size-100 md-size-25">
        <stats-card header-color="rose">
          <template slot="header">
            <div class="card-icon">
              <md-icon>equalizer</md-icon>
            </div>
            <p class="category">الزيارات</p>
            <h3 class="title">
              75.521
            </h3>
          </template>

          <template slot="footer">
            <div class="stats">
              <md-icon>local_offer</md-icon>
              تعقب
            </div>
          </template>
        </stats-card>
      </div>
      <div class="md-layout-item md-medium-size-50 md-xsmall-size-100 md-size-25">
        <stats-card header-color="green">
          <template slot="header">
            <div class="card-icon">
              <md-icon>store</md-icon>
            </div>
            <p class="category">إيرادات</p>
            <h3 class="title">
              $ 34.245
            </h3>
          </template>

          <template slot="footer">
            <div class="stats">
              <md-icon>date_range</md-icon>
              أخر 24 ساعه
            </div>
          </template>
        </stats-card>
      </div>
      <div class="md-layout-item md-medium-size-50 md-xsmall-size-100 md-size-25">
        <stats-card header-color="warning">
          <template slot="header">
            <div class="card-icon">
              <md-icon>weekend</md-icon>
            </div>
            <p class="category">الحجوزات</p>
            <h3 class="title">
              184
            </h3>
          </template>

          <template slot="footer">
            <div class="stats">
              <md-icon class="text-danger">warning</md-icon>
              <a href="#pablo">المزيد من المساحة</a>
            </div>
          </template>
        </stats-card>
      </div>

    <div
          class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-33"
      >
        <chart-card
            :chart-data="emailsSubscriptionChart.data"
            :chart-options="emailsSubscriptionChart.options"
            :chart-responsive-options="emailsSubscriptionChart.responsiveOptions"
            chart-type="Bar"
            chart-inside-header
            background-color="rose"
        >
          <template slot="content">
            <h4 class="title">الآراء</h4>
            <p class="category">
              أداء الحملة
            </p>
          </template>

          <template slot="footer">
            <div class="stats">
              <md-icon>access_time</md-icon>
              قبل 10 دقيقة
            </div>
          </template>
        </chart-card>
      </div>
      <div
          class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-33"
      >
        <chart-card
            :chart-data="dailySalesChart.data"
            :chart-options="dailySalesChart.options"
            chart-type="Line"
            chart-inside-header
            background-color="green"
        >
          <template slot="content">
            <h4 class="title">المبيعات اليومية</h4>
            <p class="category">
            <span class="text-success"
            ><i class="fas fa-long-arrow-alt-up"></i>
              55%
            </span>
              زيادة
            </p>
          </template>

          <template slot="footer">
            <div class="stats">
              <md-icon>access_time</md-icon>
              قبل 4 دقيقة
            </div>
          </template>
        </chart-card>
      </div>
      <div
          class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-33"
      >
        <chart-card
            :chart-data="dataCompletedTasksChart.data"
            :chart-options="dataCompletedTasksChart.options"
            chart-type="Line"
            chart-inside-header
            background-color="blue"
        >
          <template slot="content">
            <h4 class="title">الآراء</h4>
            <p class="category">
              أداء الحملة
            </p>
          </template>

          <template slot="footer">
            <div class="stats">
              <md-icon>access_time</md-icon>
              قبل 24 دقيقة
            </div>
          </template>
        </chart-card>
      </div>

      <div
          class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-50"
      >
        <md-card>
          <md-card-header class="md-card-header-text md-card-header-warning">
            <div class="card-text">
              <h4 class="title">لتكاليف يبق</h4>
              <p class="category">
                بالإنزال وفي. خيار ومضى العمليات تم ذلك, تم معقل مرمى
              </p>
            </div>
          </md-card-header>
          <md-card-content>
            <md-table v-model="users" table-header-color="orange">
              <md-table-row slot="md-table-row" slot-scope="{ item }">
                <md-table-cell md-label="وتم">{{ item.id }}</md-table-cell>
                <md-table-cell md-label="لأمريكية هذا">{{ item.name }}</md-table-cell>
                <md-table-cell md-label="شاسعالأمريكية">{{ item.salary }}</md-table-cell>
                <md-table-cell md-label="الأمريكية">{{ item.country
                  }}</md-table-cell>
              </md-table-row>
            </md-table>
          </md-card-content>
        </md-card>
      </div>

      <div
          class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-50"
      >
        <nav-tabs-card>
          <template slot="content">
            <span class="md-nav-tabs-title">منتصف:</span>
            <md-tabs md-sync-route class="md-rose" md-alignment="left">
              <md-tab id="tab-home" md-label="ضرب" md-icon="bug_report">
                <md-table v-model="firstTabs" @md-selected="onSelect">
                  <md-table-row
                      slot="md-table-row"
                      slot-scope="{ item }"
                      md-selectable="multiple"
                      md-auto-select
                  >
                    <md-table-cell>{{ item.tab }}</md-table-cell>
                    <md-table-cell>
                      <md-button class="md-just-icon md-simple md-primary">
                        <md-icon>edit</md-icon>
                        <md-tooltip md-direction="top">Edit</md-tooltip>
                      </md-button>
                      <md-button class="md-just-icon md-simple md-danger">
                        <md-icon>close</md-icon>
                        <md-tooltip md-direction="top">Close</md-tooltip>
                      </md-button>
                    </md-table-cell>
                  </md-table-row>
                </md-table>
              </md-tab>

              <md-tab id="tab-pages" md-label="السفن" md-icon="code">
                <md-table v-model="secondTabs" @md-selected="onSelect">
                  <md-table-row
                      slot="md-table-row"
                      slot-scope="{ item }"
                      md-selectable="multiple"
                      md-auto-select
                  >
                    <md-table-cell>{{ item.tab }}</md-table-cell>
                    <md-table-cell>
                      <md-button class="md-just-icon md-simple md-primary">
                        <md-icon>edit</md-icon>
                        <md-tooltip md-direction="top">Edit</md-tooltip>
                      </md-button>
                      <md-button class="md-just-icon md-simple md-danger">
                        <md-icon>close</md-icon>
                        <md-tooltip md-direction="top">Close</md-tooltip>
                      </md-button>
                    </md-table-cell>
                  </md-table-row>
                </md-table>
              </md-tab>

              <md-tab id="tab-posts" md-label="فصل." md-icon="cloud">
                <md-table v-model="thirdTabs" @md-selected="onSelect">
                  <md-table-row
                      slot="md-table-row"
                      slot-scope="{ item }"
                      md-selectable="multiple"
                      md-auto-select
                  >
                    <md-table-cell>{{ item.tab }}</md-table-cell>
                    <md-table-cell>
                      <md-button class="md-just-icon md-simple md-primary">
                        <md-icon>edit</md-icon>
                        <md-tooltip md-direction="top">Edit</md-tooltip>
                      </md-button>
                      <md-button class="md-just-icon md-simple md-danger">
                        <md-icon>close</md-icon>
                        <md-tooltip md-direction="top">Close</md-tooltip>
                      </md-button>
                    </md-table-cell>
                  </md-table-row>
                </md-table>
              </md-tab>
            </md-tabs>
          </template>
        </nav-tabs-card>
      </div>

    </div>
</template>

<script>
import {
  NavTabsCard,
  StatsCard,
  ChartCard,
} from "@/components";

export default {
  components: {
    StatsCard,
    ChartCard,
    NavTabsCard
  },
  props: {
    profileCard: {
      type: String,
      default: process.env.VUE_APP_APP_BASE_URL + "/img/faces/card-profile1-square.jpg"
    }
  },
  data() {
    return {
      selected: [],
      firstTabs: [
        { tab: " فقد لمحاكم الاندونيسية, بلاده بالتوقيع تم يبق. جعل السبب وفرنسا الصينية أي."},
        { tab: "بحث. كل مما ٢٠٠٤ شاسعة العسكري جعل السبب وفرنسا الصينية أي." },
        { tab: "تسبب أفريقيا ضرب عن, عن إنطلاق جعل السبب وفرنسا الصينية أي." }
      ],
      secondTabs: [
        {
          tab:
            "قدما مليون بين عن, مرجع منتصف الأمريكية  جعل السبب وفرنسا الصينية أي."
        },
        {
          tab:
            "قدما مليون بين عن, مرجع منتصف الأمريكية  جعل السبب وفرنسا الصينية أي."
        },
        {
          tab:
            "قدما مليون بين عن, مرجع منتصف الأمريكية  جعل السبب وفرنسا الصينية أي."
        }
      ],
      thirdTabs: [
        {
          tab:
            "قدما مليون بين عن, مرجع منتصف الأمريكية  جعل السبب وفرنسا الصينية أي."
        },
        {
          tab:
            "قدما مليون بين عن, مرجع منتصف الأمريكية  جعل السبب وفرنسا الصينية أي."
        },
        {
          tab:
            "قدما مليون بين عن, مرجع منتصف الأمريكية  جعل السبب وفرنسا الصينية أي."
        }
      ],
      users: [
        {
          id: 1,
          name: "السبب وفرنسا الصينية ",
          salary: "$36,738",
          country: "تكاليف "
        },
        {
          id: 2,
          name: "بمباركة بها",
          salary: "$23,738",
          country: "الأمريكية من"
        },
        {
          id: 3,
          name: "شاسعالأمريكية",
          salary: "$56,142",
          country: "السفن وعُرفت"
        },
        {
          id: 4,
          name: "الاندونيسية",
          salary: "$38,735",
          country: "فصل."
        }
      ],
      dailySalesChart: {
        data: {
          labels: ["M", "T", "W", "T", "F", "S", "S"],
          series: [[12, 17, 7, 17, 23, 18, 38]]
        },
        options: {
          lineSmooth: this.$Chartist.Interpolation.cardinal({
            tension: 0
          }),
          low: 0,
          high: 50, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
          chartPadding: {
            top: 0,
            right: 0,
            bottom: 0,
            left: 0
          }
        }
      },
      dataCompletedTasksChart: {
        data: {
          labels: ["12am", "3pm", "6pm", "9pm", "12pm", "3am", "6am", "9am"],
          series: [[230, 750, 450, 300, 280, 240, 200, 190]]
        },

        options: {
          lineSmooth: this.$Chartist.Interpolation.cardinal({
            tension: 0
          }),
          low: 0,
          high: 1000, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
          chartPadding: {
            top: 0,
            right: 0,
            bottom: 0,
            left: 0
          }
        }
      },
      emailsSubscriptionChart: {
        data: {
          labels: [
            "Ja",
            "Fe",
            "Ma",
            "Ap",
            "Mai",
            "Ju",
            "Jul",
            "Au",
            "Se",
            "Oc",
            "No",
            "De"
          ],
          series: [[542, 443, 320, 780, 553, 453, 326, 434, 568, 610, 756, 895]]
        },
        options: {
          axisX: {
            showGrid: false
          },
          low: 0,
          high: 1000,
          chartPadding: {
            top: 0,
            right: 5,
            bottom: 0,
            left: 0
          }
        },
        responsiveOptions: [
          [
            "screen and (max-width: 640px)",
            {
              seriesBarDistance: 5,
              axisX: {
                labelInterpolationFnc: function(value) {
                  return value[0];
                }
              }
            }
          ]
        ]
      }
    };
  },
  methods: {
    onSelect: function(items) {
      this.selected = items;
    }
  }
};
</script>

<style lang="css"></style>
