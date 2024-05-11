import { getPostTypeName } from './getPostTypeName'

type InputJson = {
    postTypeKey: string
    postTypeSingularName: string
    postTypePluralName: string
    menuIcon?: string
}

type OutputJson = {
    key: string
    title: string
    menu_order: number
    active: boolean
    post_type: string
    advanced_configuration: boolean
    import_source: string
    import_date: string
    labels: Record<string, string>
    description: string
    public: boolean
    hierarchical: boolean
    exclude_from_search: boolean
    publicly_queryable: boolean
    show_ui: boolean
    show_in_menu: boolean
    admin_menu_parent: string
    show_in_admin_bar: boolean
    show_in_nav_menus: boolean
    show_in_rest: boolean
    rest_base: string
    rest_namespace: string
    rest_controller_class: string
    menu_position: string
    menu_icon: string
    rename_capabilities: boolean
    singular_capability_name: string
    plural_capability_name: string
    supports: string[]
    taxonomies: string[]
    has_archive: boolean
    has_archive_slug: string
    rewrite: {
        permalink_rewrite: string
        with_front: string
        feeds: string
        pages: string
    }
    query_var: string
    query_var_name: string
    can_export: boolean
    delete_with_user: boolean
    register_meta_box_cb: string
    enter_title_here: string
}

export const generatePostTypeJSON = (input: InputJson): OutputJson => {
    const baseType = getPostTypeName(input.postTypeSingularName)
    const baseLabel = input.postTypeSingularName + ' Type'

    return {
        key:
            input.postTypeKey ||
            'post_type_' + Math.random().toString(16).slice(2, 10), //input.postTypeKey || 'post_type_663d8b2f3d99d',
        title: input.postTypePluralName + ' Types',
        menu_order: 0,
        active: true,
        post_type: baseType.toLowerCase(),
        advanced_configuration: true,
        import_source: '',
        import_date: '',
        labels: {
            name: input.postTypePluralName + ' Types',
            singular_name: baseLabel,
            menu_name: baseLabel,
            all_items: 'All ' + baseLabel,
            edit_item: 'Edit ' + baseLabel,
            view_item: 'View ' + baseLabel,
            view_items: 'View ' + baseLabel,
            add_new_item: 'Add New ' + baseLabel,
            add_new: 'Add New ' + baseLabel,
            new_item: 'New ' + baseLabel,
            parent_item_colon: 'Parent ' + baseLabel + ':',
            search_items: 'Search ' + baseLabel,
            not_found: 'No ' + baseType.toLowerCase() + ' type found',
            not_found_in_trash:
                'No ' + baseType.toLowerCase() + ' type found in Trash',
            archives: baseLabel + ' Archives',
            attributes: baseLabel + ' Attributes',
            featured_image: '',
            set_featured_image: '',
            remove_featured_image: '',
            use_featured_image: '',
            insert_into_item: 'Insert into ' + baseType.toLowerCase() + ' type',
            uploaded_to_this_item:
                'Uploaded to this ' + baseType.toLowerCase() + ' type',
            filter_items_list:
                'Filter ' + baseType.toLowerCase() + ' type list',
            filter_by_date:
                'Filter ' + baseType.toLowerCase() + ' type by date',
            items_list_navigation: baseType + ' list navigation',
            items_list: baseType + ' list',
            item_published: baseType + ' published.',
            item_published_privately: baseType + ' published privately.',
            item_reverted_to_draft: baseType + ' reverted to draft.',
            item_scheduled: baseType + ' scheduled.',
            item_updated: baseType + ' updated.',
            item_link: baseType + ' Link',
            item_link_description:
                'A link to a ' + baseType.toLowerCase() + ' type.',
        },
        description: '',
        public: true,
        hierarchical: false,
        exclude_from_search: false,
        publicly_queryable: true,
        show_ui: true,
        show_in_menu: true,
        admin_menu_parent: '',
        show_in_admin_bar: true,
        show_in_nav_menus: true,
        show_in_rest: true,
        rest_base: '',
        rest_namespace: 'wp/v2',
        rest_controller_class: 'WP_REST_Posts_Controller',
        menu_position: '',
        menu_icon: input.menuIcon || 'dashicons-clipboard',
        rename_capabilities: false,
        singular_capability_name: 'post',
        plural_capability_name: 'posts',
        supports: ['title', 'author', 'editor', 'thumbnail', 'custom-fields'],
        taxonomies: ['category', 'post_tag'],
        has_archive: false,
        has_archive_slug: '',
        rewrite: {
            permalink_rewrite: 'post_type_key',
            with_front: '1',
            feeds: '0',
            pages: '1',
        },
        query_var: 'post_type_key',
        query_var_name: '',
        can_export: true,
        delete_with_user: false,
        register_meta_box_cb: '',
        enter_title_here: '',
    }
}
