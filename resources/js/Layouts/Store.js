import React from 'react';
import StoreHead from '@/Layouts/Store/StoreHead';
import StoreFooter from '@/Layouts/Store/StoreFooter';
import PreviousMap from 'postcss/lib/previous-map';

export default function Store({ children,user,errors}) {


    return (
        <>

            <StoreHead user={user} errors={errors}></StoreHead>

                {children}

            <StoreFooter></StoreFooter>

        </>


    );
}
