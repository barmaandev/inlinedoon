(function () {
    const { registerPlugin } = wp.plugins;
    const { PluginDocumentSettingPanel } = wp.editPost;
    const { createElement: el } = wp.element;
    const { dispatch } = wp.data;
    const { __ } = wp.i18n;
    const { Button } = wp.components;
    const { registerBlockVariation } = wp.blocks;

    function insertShortcodeBlock() {
        const shortcode = (window.InlineDoonGutenberg && window.InlineDoonGutenberg.shortcode) || '[inlinedoon_carousel]';
        const block = wp.blocks.createBlock('core/shortcode', { text: shortcode });
        if (block) {
            dispatch('core/block-editor').insertBlocks(block);
        }
    }

    const InlineDoonPanel = () => (
        el(PluginDocumentSettingPanel,
            { name: 'inlinedoon-shortcode-panel', title: __('InlineDoon', 'inlinedoon'), className: 'inlinedoon-shortcode-panel', initialOpen: true },
            el('p', null, el('code', null, (window.InlineDoonGutenberg && window.InlineDoonGutenberg.shortcode) || '[inlinedoon_carousel]')),
            el(Button, { isPrimary: true, onClick: insertShortcodeBlock }, __('Insert InlineDoon Shortcode', 'inlinedoon'))
        )
    );

    registerPlugin('inlinedoon-shortcode-panel', { render: InlineDoonPanel, icon: 'admin-links' });

    // Also register a block variation so it appears in the inserter search
    try {
        registerBlockVariation('core/shortcode', {
            name: 'inlinedoon',
            title: __('InlineDoon', 'inlinedoon'),
            description: __('Insert InlineDoon shortcode', 'inlinedoon'),
            icon: 'admin-links',
            attributes: { text: (window.InlineDoonGutenberg && window.InlineDoonGutenberg.shortcode) || '[inlinedoon_carousel]' },
            scope: ['inserter'],
            keywords: ['inlinedoon', 'inline doon', 'اینلاین دون', 'این لاین دون']
        });
    } catch (e) {
        if (window && window.console) {
            console.warn('[InlineDoon] Could not register block variation', e);
        }
    }
})();


