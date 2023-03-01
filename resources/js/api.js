import axios from 'axios';
window.axios = axios;

export const MountainAPI = () => {

    const [area, setArea] = useState("")
    const [name, setName] = useState("")
    const [latitude, setLatitude] = useState("")
    const [longitude, setLongitude] = useState("")
    const [prefectures, setPrefectures] = useState("")
    const [gsiUrl, setGsiUrl] = useState("")
    const [id, setID] = useState('396')
    const [place, setPlace] = useState("");
    const [weather, setWeather] = useState("");
    const [shop, setShop] = useState("");

    const ids = Array.from({ length: 1200 }, (_, i) => i + 1);

    const getRandomID = () => {
        const _id = ids[Math.floor(Math.random() * ids.length)]
        setID(_id)
    }
    useEffect(() => {
        fetch(`https://mountix.codemountains.org/api/v1/mountains/${id}`)
            .then(res => res.json())
            .then(data => {
                console.log(data)
                setName(data.name)
                setArea(data.area)
                setPrefectures(data.prefectures)
                setLatitude(data.location.latitude)
                setLongitude(data.location.longitude)
                setGsiUrl(data.location.gsiUrl)
            })
            .catch(error => {
                console.error(error)
            })
    }, [id]);

    useEffect(() => {
    })
}