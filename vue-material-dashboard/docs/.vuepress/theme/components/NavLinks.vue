<template>
  <nav
    class="nav-links"
    v-if="userLinks.length || repoLink"
  >
    <!-- user links -->
    <!-- <div
      class="nav-item"
      v-for="item in userLinks"
      :key="item.link"
    >
      <DropdownLink
        v-if="item.type === 'links'"
        :item="item"
      />
      <NavLink
        v-else
        :item="item"
      />
    </div> -->

    <div
      class="nav-item"
    >
        <div class="nav-item"><a class="nav-link" href="https://www.creative-tim.com/product/vue-material-dashboard-laravel-pro-bs4" target="_blank"> <i class="material-icons">card_membership</i> Upgrade to PRO <div class="ripple-container"></div></a></div>
        <div class="nav-item"><a href="https://explore.postman.com/api/6357/laravel-jsonapi" target="_blank" class="nav-link"><i class="material-icons">content_paste</i> Laravel API Documentation</a></div>
        <div class="nav-item"><a href="https://vue-material-dashboard-laravel-bs4.creative-tim.com/" target="_blank" rel="noopener noreferrer" class="nav-link external">
            <i class="material-icons">view_carousel</i> Live Preview</a>
        </div>
        <div class="nav-item"><a href="https://github.com/creativetimofficial/vue-material-dashboard-laravel-bs4" target="_blank" rel="noopener noreferrer" class="nav-link external">
            <i class="material-icons">star</i> Help with a star</a>
        </div>
    </div>

    <!-- repo link -->
    <!-- <a
      v-if="repoLink"
      :href="repoLink"
      class="repo-link"
      target="_blank"
      rel="noopener noreferrer"
    >
      {{ repoLabel }}
      <OutboundLink/>
    </a> -->
  </nav>
</template>

<script>
import DropdownLink from '@theme/components/DropdownLink.vue'
import { resolveNavLinkItem } from '@parent-theme/util'
import NavLink from '@theme/components/NavLink.vue'

export default {
  components: { NavLink, DropdownLink },

  computed: {
    userNav () {
      return this.$themeLocaleConfig.nav || this.$site.themeConfig.nav || []
    },

    nav () {
      const { locales } = this.$site
      if (locales && Object.keys(locales).length > 1) {
        const currentLink = this.$page.path
        const routes = this.$router.options.routes
        const themeLocales = this.$site.themeConfig.locales || {}
        const languageDropdown = {
          text: this.$themeLocaleConfig.selectText || 'Languages',
          items: Object.keys(locales).map(path => {
            const locale = locales[path]
            const text = themeLocales[path] && themeLocales[path].label || locale.lang
            let link
            // Stay on the current page
            if (locale.lang === this.$lang) {
              link = currentLink
            } else {
              // Try to stay on the same page
              link = currentLink.replace(this.$localeConfig.path, path)
              // fallback to homepage
              if (!routes.some(route => route.path === link)) {
                link = path
              }
            }
            return { text, link }
          })
        }
        return [...this.userNav, languageDropdown]
      }
      return this.userNav
    },

    userLinks () {
      return (this.nav || []).map(link => {
        return Object.assign(resolveNavLinkItem(link), {
          items: (link.items || []).map(resolveNavLinkItem)
        })
      })
    },

    repoLink () {
      const { repo } = this.$site.themeConfig
      if (repo) {
        return /^https?:/.test(repo)
          ? repo
          : `https://github.com/${repo}`
      }
    },

    repoLabel () {
      if (!this.repoLink) return
      if (this.$site.themeConfig.repoLabel) {
        return this.$site.themeConfig.repoLabel
      }

      const repoHost = this.repoLink.match(/^https?:\/\/[^/]+/)[0]
      const platforms = ['GitHub', 'GitLab', 'Bitbucket']
      for (let i = 0; i < platforms.length; i++) {
        const platform = platforms[i]
        if (new RegExp(platform, 'i').test(repoHost)) {
          return platform
        }
      }

      return 'Source'
    }
  }
}
</script>

<style lang="stylus">
@import '~@parent-theme/styles/config.styl'

.nav-links
  display inline-block
  a
    line-height 1.4rem
    color inherit
    &:hover, &.router-link-active
      color $accentColor
  .nav-item
    position relative
    display inline-block
    margin-left 1.5rem
    line-height 2rem
    &:first-child
      margin-left 0
  .repo-link
    margin-left 1.5rem

@media (max-width: $MQMobile)
  .nav-links
    .nav-item, .repo-link
      margin-left 0

@media (min-width: $MQMobile)
  .nav-links a
    &:hover, &.router-link-active
      color $textColor
  .nav-item > a:not(.external)
    &:hover, &.router-link-active
      margin-bottom -2px
      border-bottom 2px solid lighten($accentColor, 8%)
</style>
