import {isEmpty, isEqual, omit, pick} from 'lodash';

export default {
  data() {
    return {
      isLoading: false,
      apiValidationErrors: {}
    };
  },
  methods: {
    /* extract API server validation errors and assigns them to local mixin data */
    setApiValidation(serverErrors, refs = null) {
      this.apiValidationErrors = serverErrors.reduce(
        (accumulator, errorObject) => {
          if(typeof errorObject.source === 'undefined')
            return false;

          const errorFieldName = errorObject.source.pointer.split('/')[3];
          const errorDetail = (accumulator[errorFieldName] || []).concat(errorObject.detail);

          return {
            ...accumulator,
            [errorFieldName]: errorDetail
          };
        },
        {}
      );
    }
  }
};
