# app/routes/test.py
from fastapi import APIRouter
from models.weightprediction_model import WeightPrediction
from services.result import recommend_exercise_and_calories

router = APIRouter()

@router.post("/predict-weight")
async def predict_weight(data: WeightPrediction):
    try:
        exercise, calories = recommend_exercise_and_calories(
            data.actual_weight,
            data.age,
            1 if data.gender_male else 0,
            data.dream_weight,
            data.duration,
            data.bmi,
            1 if data.weather_rainy else 0,
            1 if data.weather_sunny else 0
        )
        return {"recommended_exercise": exercise, "predicted_Calories_to_Burn": calories}
    except Exception as e:
        return {"error": str(e)}
