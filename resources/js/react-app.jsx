import React from 'react';
import { createRoot } from 'react-dom/client';
import AuroraBackground from './components/AuroraBackground';
import SplitText from './components/SplitText';
import ShinyText from './components/ShinyText';

// Object mapping component names to their actual React components
const components = {
    AuroraBackground,
    SplitText,
    ShinyText,
};

// Function to mount all React components on the page
function mountReactComponents() {
    document.querySelectorAll('[data-react-component]').forEach((el) => {
        const componentName = el.getAttribute('data-react-component');
        const Component = components[componentName];

        if (Component && !el.dataset.reactMounted) {
            // Parse props from data-props attribute if it exists
            const propsStr = el.getAttribute('data-props');
            let props = {};
            try {
                if (propsStr) {
                    props = JSON.parse(propsStr);
                }
            } catch (e) {
                console.error(`Failed to parse props for ${componentName}:`, e);
            }

            // Also parse children from data-children if we want to pass text
            const childrenText = el.getAttribute('data-children');
            if (childrenText) {
                props.children = childrenText;
            }

            const root = createRoot(el);
            root.render(<Component {...props} />);
            
            // Mark as mounted so we don't mount again on Livewire updates
            el.dataset.reactMounted = 'true';
        }
    });
}

// Mount on initial load
document.addEventListener('DOMContentLoaded', mountReactComponents);

// Mount after Livewire navigations/updates
if (typeof window.Livewire !== 'undefined') {
    window.Livewire.hook('morph.updated', () => {
        mountReactComponents();
    });
} else {
    document.addEventListener('livewire:navigated', mountReactComponents);
}
