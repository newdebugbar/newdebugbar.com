import requestInspectorDesktopDark from '../images/screenshots/request-inspector-desktop-dark.png';
import requestInspectorDesktopLight from '../images/screenshots/request-inspector-desktop-light.png';
import requestInspectorMobileDark from '../images/screenshots/request-inspector-mobile-dark.png';
import requestInspectorMobileLight from '../images/screenshots/request-inspector-mobile-light.png';
import { initializeSite } from './site.js';

initializeSite({
    screenshots: {
        desktop: {
            dark: requestInspectorDesktopDark,
            light: requestInspectorDesktopLight,
        },
        mobile: {
            dark: requestInspectorMobileDark,
            light: requestInspectorMobileLight,
        },
    },
});
