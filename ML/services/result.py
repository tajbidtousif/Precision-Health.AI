import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.linear_model import LinearRegression
from sklearn.metrics import mean_squared_error


exercise_df1 = pd.read_csv('data/exercise_dataset_1.csv')
exercise_df2 = pd.read_csv('data/exercise_dataset_2.csv')

print(exercise_df1.head())
print(exercise_df2.head())
print(exercise_df2.isnull().sum())

exercise_df2 = pd.get_dummies(exercise_df2, columns=['Gender', 'Weather Conditions'], drop_first=True)
exercise_df2['Weight Difference'] = exercise_df2['Dream Weight'] - exercise_df2['Actual Weight']
print(exercise_df2.head())

# Defining our features and target
X = exercise_df2[['Actual Weight', 'Age', 'Gender_Male', 'Dream Weight', 'Duration','BMI', 'Weather Conditions_Rainy', 'Weather Conditions_Sunny']]
y = exercise_df2['Calories Burn']

# Splitting the data into training and testing sets (80% training, 20% testing)
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

# Initialize the model
lr_model = LinearRegression()

# Train the model
lr_model.fit(X_train, y_train)

# Predict on the training set
train_preds = lr_model.predict(X_train)

# Calculate the mean squared error on the training data
mse_train = mean_squared_error(y_train, train_preds)
print(f"Training Mean Squared Error: {mse_train}")

# Predict on the testing set
test_preds = lr_model.predict(X_test)

# Calculate the mean squared error on the testing data
mse_test = mean_squared_error(y_test, test_preds)
print(f"Testing Mean Squared Error: {mse_test}")

def recommend_exercise_and_calories(weight, age, gender_male, dream_weight, duration, bmi, rainy, sunny):
    # Predicting the calories to burn
    input_data = [[weight, age, gender_male, dream_weight, duration, bmi, rainy, sunny]]
    predicted_calories = lr_model.predict(input_data)[0]

    # Find the closest matching exercise
    exercise_df1['calorie_difference'] = abs(exercise_df1['Calories per kg'] * weight - predicted_calories)
    recommended_exercise = exercise_df1.loc[exercise_df1['calorie_difference'].idxmin()]['Activity, Exercise or Sport (1 hour)']

    return recommended_exercise, predicted_calories

# Example user data
user_weight = 80
user_age = 20
user_gender = 0  # Male: 1, Female: 0
user_dream_weight = 70
user_duration = 30
user_bmi = 28
user_rainy = 1
user_sunny = 0

# Call the function
exercise, calories = recommend_exercise_and_calories(user_weight, user_age, user_gender, user_dream_weight, user_duration, user_bmi, user_rainy, user_sunny)

print(f"recommended_exercise: {exercise}")
print(f"predicted_calorise_to_burn: {calories}")

