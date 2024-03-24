# app/models/weightprediction_model.py
from pydantic import BaseModel

class WeightPrediction(BaseModel):
    actual_weight: float
    age: int
    gender_male: bool  # True for male, False for female
    dream_weight: float
    duration: int
    bmi: float
    weather_rainy: bool
    weather_sunny: bool

