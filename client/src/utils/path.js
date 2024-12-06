const path = {
    PUBLIC: '/',
    HOME: '',
    ALL: '*',
    LOGIN: 'login',
    PRODUCT: ':category',
    DETAIL_PRODUCT: 'product/:productId', 
    FINAL_REGISTER: 'finalRegister/:status',
    RESET_PASSWORD: 'reset-password/:token',

    // ADMIN
    ADMIN: 'admin',
    DASHBOARD: 'dasboard',
    MANAGE_USERS: 'manage-users',
    MANAGE_PRODUCTS: 'manage-products',
    MANAGE_ORDERS: 'manage-orders',

    // MEMBER
    MEMBER: 'member',
    PERSONAL: 'personal',
    CHECK_ORDER: 'check-order',
}

export default path;
