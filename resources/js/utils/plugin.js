/**
 * Runs the setup function if a plugin is present in the page
 * 
 * @param {string[]} plugins
 * @param {CallableFunction} setupPlugin 
 */
export function pluginRun(plugins, setupPlugin) {
    const pluginsMeta = document.querySelector(`meta[name="plugins"]`);

    if (!(pluginsMeta instanceof HTMLMetaElement)) {
        console.warn("Plugin meta tag is not present!");
        return;
    }

    const loadedPlugins = pluginsMeta.content.split(' ');
    const loaded = plugins.every(plugin => loadedPlugins.includes(plugin))

    if (loaded) {
        setupPlugin();
        return;
    }

    console.info(`Plugin not loaded due to missing full set of ${plugins}!`);
}