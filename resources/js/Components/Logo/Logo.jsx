import { FaBasketShopping } from "react-icons/fa6";

export const Logo = ({size, fontSize}) => {
    return (
        <div className={`flex justify-center items-center rounded-full border border-transparent bg-white`} style={{ width: size, height: size }}>
            <div className="w-100 h-100 bg-black rounded-full">
                <FaBasketShopping  className="text-black bg-white"  style={{fontSize: fontSize }}/>
            </div>
        </div>
    );
}

